<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * A qtype_speakautograde adhoc task
 *
 * @package    qtype_speakautograde
 * @copyright  2015 Justin Hunt (poodllsupport@gmail.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace qtype_speakautograde\task;

defined('MOODLE_INTERNAL') || die();

use \qtype_speakautograde\cloudpoodll\constants;
use \qtype_speakautograde\cloudpoodll\utils;


/**
 * A mod_readaloud adhoc task to fetch back transcriptions from Amazon S3
 *
 * @package    qtype_speakautograde
 * @since      Moodle 2.7
 * @copyright  2015 Justin Hunt (poodllsupport@gmail.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class fetch_transcript_adhoc extends \core\task\adhoc_task {
                                                                     
   	 /**
     *  Run the tasks
     */
	 public function execute(){
	     global $DB;
		$trace = new \text_progress_trace();
		$cd =  $this->get_custom_data();

        /* $cd properties */
        /*
        $cd->audiourl
        $cd->qa
        $cd->question
        $cd->taskcreationtime
        */


         $transcript = utils::fetch_transcript($cd->audiourl);
         if($transcript===false){
             if($cd->taskcreationtime + (HOURSECS * 24) < time()){
                 $this->do_forever_fail('No transcript could be found',$trace);
                 return;
             }else{
                 $this->do_retry_soon('Transcript appears to not be ready yet',$trace,$cd);
                 return;
             }
         } else {
             //yay!!! we have a transcript ... now what ?
             return;
         }
	}

    protected function do_retry_soon($reason,$trace,$customdata){
        if($customdata->taskcreationtime + (MINSECS * 15) < time()){
            $this->do_retry_delayed($reason,$trace);
        }else {
            $trace->output($reason . ": will try again next cron ");
            $fetch_task = new \qtype_speakautograde\task\fetch_transcript_adhoc();
            $fetch_task->set_component('qtype_speakautograde');
            $fetch_task->set_custom_data($customdata);
            // queue it
            \core\task\manager::queue_adhoc_task($fetch_task);
        }
    }

    protected function do_retry_delayed($reason,$trace){
        $trace->output($reason . ": will retry after a delay ");
        throw new \file_exception('retrievefileproblem', 'could not fetch transcript.');
    }

    protected function do_forever_fail($reason,$trace){
        $trace->output($reason . ": will not retry ");
	}

}

