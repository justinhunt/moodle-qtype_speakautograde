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
 * Question type class for the speakautograde question type.
 *
 * @package    qtype
 * @subpackage speakautograde
 * @copyright  2005 Mark Nielsen
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/question/type/essayautograde/questiontype.php');

/**
 * The speakautograde question type.
 *
 * @copyright  2005 Mark Nielsen
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_speakautograde extends qtype_essayautograde {

    public function extra_question_fields() {
        $fields = parent::extra_question_fields();
        //
        // add Poodll fields here
        //
        return $fields;
    }

    public function save_question_options($formdata) {
        parent::save_question_options($formdata);
        //
        // save Poodll options here
        //
        return true;
    }

    protected function initialise_question_instance(question_definition $question, $questiondata) {
        parent::initialise_question_instance($question, $questiondata);
        //
        // Initialize Poodll fields here
        //
    }

    public function delete_question($questionid, $contextid) {
        //
        // Delete Poodll stuff here
        //
        parent::delete_question($questionid, $contextid);
    }

    /**
     * based on "regrade_attempt()" method
     * in "mod/quiz/report/overview/report.php"
     */
    protected function regrade_question($questionid) {
        //
        // Regrade Poodll stuff
        //
        parent::regrade_question($questionid);
    }

    /**
     * get_default_values
     *
     * @return array of default values for a new question
     */
    static public function get_default_values($questionid=0, $feedback=false) {    
        $values = parent::get_default_values($questionid=0, $feedback=false);
        //
        // Add Poodll values here
        //
        return $values;
    }
}
