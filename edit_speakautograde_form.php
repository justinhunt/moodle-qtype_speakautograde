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
 * Defines the editing form for the speakautograde question type.
 *
 * @package    qtype
 * @subpackage speakautograde
 * @copyright  2007 Jamie Pratt me@jamiep.org
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// get parent class
require_once($CFG->dirroot.'/question/type/essayautograde/edit_essayautograde_form.php');

/**
 * Speak question type editing form.
 *
 * @copyright  2007 Jamie Pratt me@jamiep.org
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_speakautograde_edit_form extends qtype_essayautograde_edit_form {

    /**
     * Plugin name is class name without trailing "_edit_form"
     */
    public function plugin_name() {
        return substr(get_class($this), 0, -10);
    }

    protected function definition_inner($mform) {
        global $PAGE;

        parent::definition_inner($mform);

        $plugin = "qtype_speakautograde";
        $qtype = question_bank::get_qtype('speakautograde');

        // add audio and video options to the response options
        if ($mform->elementExists('responseformat')) {
            $mform->removeElement('responseformat', false);
        }
        $responseformat = $mform->createElement('select', 'responseformat',
            get_string('responseformat', 'qtype_essay'), $qtype->response_formats());
        $mform->insertElementBefore($responseformat,'responsetemplateheader');
        $mform->setDefault('responseformat', 'audio');

        ////////////////////////////////////////////////
        /// CLOUD POODLL API
        /////////////////////////////////////////////////
        $name = 'recordingheader';
        $label = get_string($name, $plugin);
        $mform->addElement('header', $name, $label);
        $mform->setExpanded($name, true);

        $plugin = 'qtype_speakautograde';
        $config = get_config($plugin);

        //timelimit
        $timelimitoptions = \qtype_speakautograde\cloudpoodll\utils::get_timelimit_options();
        $mform->addElement('select', 'timelimit', get_string('timelimit', $plugin),
            $timelimitoptions);
        $mform->setDefault('timelimit',60);

        //language options
        $langoptions = \qtype_speakautograde\cloudpoodll\utils::get_lang_options();
        $mform->addElement('select', 'language', get_string('language', $plugin), $langoptions);
        $mform->setDefault('language',$config->language);

        //audioskin
        $skinoptions = \qtype_speakautograde\cloudpoodll\utils::fetch_options_skins(\qtype_speakautograde\cloudpoodll\constants::REC_AUDIO);
        $mform->addElement('select', 'audioskin', get_string('audioskin', $plugin), $skinoptions);
        $mform->setDefault('audioskin',$config->audioskin);

        //videoskin
        $skinoptions = \qtype_speakautograde\cloudpoodll\utils::fetch_options_skins(\qtype_speakautograde\cloudpoodll\constants::REC_VIDEO);
        $mform->addElement('select', 'videoskin', get_string('videoskin', $plugin), $skinoptions);
        $mform->setDefault('videoskin',$config->videoskin);

        //transcriber
        $transcriberoptions = \qtype_speakautograde\cloudpoodll\utils::fetch_options_transcribers();
        $mform->addElement('select', 'transcriber', get_string('transcriber', $plugin), $transcriberoptions);
        $mform->setDefault('transcriber',$config->transcriber);

        //transcode
        $mform->addElement('advcheckbox', 'transcode', get_string('transcode', $plugin),
            get_string('transcode_details', $plugin));
        $mform->setDefault('transcode',$config->transcode);

        //expiredays
        $expiredaysoptions = \qtype_speakautograde\cloudpoodll\utils::get_expiredays_options();
        $mform->addElement('select', 'expiredays', get_string('expiredays', $plugin), $expiredaysoptions);
        $mform->setDefault('expiredays',$config->expiredays);

    }

    protected function data_preprocessing($question) {
        $question = parent::data_preprocessing($question);

        // process fields for Poodll plyer
        /*
        $question->timelimit = $question->options->timelimit;
        $question->language = $question->options->language;
        $question->audioskin = $question->options->audioskin;
        $question->videoskin = $question->options->videoskin;
        $question->transcriber = $question->options->transcriber;
        $question->transcode = $question->options->transcode;
        $question->expiredays = $question->options->expiredays;
        */

        return $question;
    }
}
