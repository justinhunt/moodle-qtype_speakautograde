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
 * Speak question definition class.
 *
 * @package    qtype
 * @subpackage speakautograde
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// prevent direct access to this script
defined('MOODLE_INTERNAL') || die();

// require the parent class
require_once($CFG->dirroot.'/question/type/essayautograde/question.php');

/**
 * Represents an speakautograde question.
 *
 * We can use almost all the methods from the parent "qtype_speak_question" class.
 * However, we override "make_behaviour" in case automatic grading is required.
 * Additionally, we implement the methods required for automatic grading.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
// interface: question_automatically_gradable
// class:     question_graded_automatically
class qtype_speakautograde_question extends qtype_essayautograde_question {
    public function update_current_response($response, $displayoptions=null) {

        //
        // update Poodll response here
        //
        if (!empty($response) && !empty($response['answeraudiourl'])) {
            $this->save_current_response('answeraudiourl', $response['answeraudiourl']);
        }
        if (!empty($response) && !empty($response['answertranscript'])) {
            $this->save_current_response('answertranscript', $response['answertranscript']);
        }

        parent::update_current_response($response, $displayoptions);

    }
    public function get_expected_data() {
        $expecteddata= parent::get_expected_data();
        $expecteddata['answertranscript'] = PARAM_RAW;
        $expecteddata['answeraudiourl'] = PARAM_URL;
        return $expecteddata;
    }
    public function is_complete_response(array $response) {
        // Determine if the given response has an audiourl
        //TO DO add check for transcripts here
        $hasaudio = array_key_exists('answeraudiourl', $response) && ($response['answeraudiourl'] !== '');

        // The response is complete iff all of our requirements are met.
        return $hasaudio;
    }

    //register an adhoc task to pick up transcripts
    public function register_fetch_transcript_task($audiourl, $qa){
        $fetch_task = new \qtype_speakautograde\task\fetch_transcript_adhoc();
        $fetch_task->set_component('qtype_speakautograde');

        $customdata = new \stdClass();
        $customdata->audiourl = $audiourl;
        $customdata->qa = $qa;
        $customdata->question = $this;
        $customdata->taskcreationtime = time();

        $fetch_task->set_custom_data($customdata);
        // queue it
        \core\task\manager::queue_adhoc_task($fetch_task);
        return true;
    }
}
