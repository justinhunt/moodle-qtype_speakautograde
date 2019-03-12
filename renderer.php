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
 * Speak question renderer class.
 *
 * @package    qtype
 * @subpackage speakautograde
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/question/type/essayautograde/renderer.php');

use qtype_speakautograde\cloudpoodll\utils;
use qtype_speakautograde\cloudpoodll\constants;

/**
 * Generates the output for speakautograde questions.
 *
 * @copyright  2009 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_speakautograde_renderer extends qtype_essayautograde_renderer {

    public function formulation_and_controls(question_attempt $qa, question_display_options $options) {
        $result = parent::formulation_and_controls($qa, $options);
        // format Poodll player here
        return $result;
    }
}

/**
 * An speakautograde format renderer for speakautogrades where the student should not enter
 * any inline response.
 *
 * @copyright  2013 Binghamton University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_speakautograde_format_noinline_renderer extends qtype_essay_format_noinline_renderer {
    protected function class_name() {
        return 'qtype_speakautograde_noinline';
    }
}

/**
 * An speakautograde format renderer for speakautogrades where the student should use the HTML
 * editor without the file picker.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_speakautograde_format_editor_renderer extends qtype_essay_format_editor_renderer {
    protected function class_name() {
        return 'qtype_speakautograde_editor';
    }
}


/**
 * An speakautograde format renderer for speakautogrades where the student should use the HTML
 * editor with the file picker.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_speakautograde_format_editorfilepicker_renderer extends qtype_essay_format_editorfilepicker_renderer {
    protected function class_name() {
        return 'qtype_speakautograde_editorfilepicker';
    }
}


/**
 * An speakautograde format renderer for speakautogrades where the student should use a plain
 * input box, but with a normal, proportional font.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_speakautograde_format_plain_renderer extends qtype_essay_format_plain_renderer {
    protected function class_name() {
        return 'qtype_speakautograde_plain';
    }
}


/**
 * An speakautograde format renderer for speakautogrades where the student should use a plain
 * input box with a monospaced font. You might use this, for example, for a
 * question where the students should type computer code.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_speakautograde_format_monospaced_renderer extends qtype_essay_format_plain_renderer {
    protected function class_name() {
        return 'qtype_speakautograde_monospaced';
    }
}

class qtype_speakautograde_format_base_renderer extends plugin_renderer_base{

    /**
     * @return string the HTML for the textarea.
     */
    protected function fetch_player($url) {

        switch($this->class_name()) {

            case 'qtype_speakautograde_video':
                $player = html_writer::tag('video','', array('src' => $url,'controls'=>true));
                break;

            case 'qtype_speakautograde_upload':
            case 'qtype_speakautograde_audio':
            default:
                $player = html_writer::tag('audio','', array('src' => $url,'controls'=>true));
        }
        return $player;
    }

    /**
     * @return string the HTML for the textarea.
     */
    protected function fetch_transcript($transcript) {
        $thetranscript = html_writer::div($transcript,'qtype_speakautograde_transcriptdiv', array());
        return $thetranscript;
    }


    /**
     * @return string the HTML for the textarea.
     */
    protected function fetch_recorder($r_options,$question, $inputname) {
        global $CFG;

        switch($this->class_name()) {
            case 'qtype_speakautograde_audio':
                $recordertype=constants::REC_AUDIO;
                $recorderskin=$question->audioskin;
                //fresh
                if($question->audioskin==constants::SKIN_FRESH){
                    $width = "400";
                    $height = "300";


                }elseif($question->audioskin==constants::SKIN_PLAIN){
                    $width = "360";
                    $height = "190";

                    //bmr 123 once standard
                }else {
                    $width = "360";
                    $height = "240";
                }
                break;

            case 'qtype_speakautograde_video':
            default:
                $recordertype=constants::REC_VIDEO;
                $recorderskin=$question->videoskin;
                //bmr 123 once
                if($question->videoskin==constants::SKIN_BMR) {
                    $width = "360";
                    $height = "450";
                }elseif($question->videoskin==constants::SKIN_123){
                    $width = "450";//"360";
                    $height = "550";//"410";
                }elseif($question->videoskin==constants::SKIN_ONCE){
                    $width = "350";
                    $height = "290";
                    //standard
                }else {
                    $width = "360";
                    $height = "410";
                }
        }

        //amazontranscribe
        $amazontranscribe =0;
        if($question->transcriber==constants::TRANSCRIBER_AMAZON_TRANSCRIBE) {
            $can_transcribe = utils::can_transcribe($r_options);
            $amazontranscribe = $can_transcribe ? "1" : "0";
        }
        //chrometranscribe
        $chrometranscribe =0;
        if($question->transcriber==constants::TRANSCRIBER_CHROME) {
            $chrometranscribe = "1";
        }

        //transcode
        $transcode = $question->transcode  ? "1" : "0";

        //time limit
        $timelimit = $question->timelimit;

        //fetch cloudpoodll token
        $api_user = get_config(constants::M_COMPONENT,'apiuser');
        $api_secret = get_config(constants::M_COMPONENT,'apisecret');
        $token = utils::fetch_token($api_user,$api_secret);


        //any recorder hints ... go here..
        $hints = new \stdClass();
        $string_hints = base64_encode (json_encode($hints));

        //the elementid of the div in the DOM
        $dom_id = html_writer::random_id('');

        $recorderdiv= \html_writer::div('', constants::M_COMPONENT  . '_notcenter',
            array('id'=>$dom_id,
                'data-id'=>'therecorder_' . $dom_id,
                'data-parent'=>$CFG->wwwroot,
                'data-localloader'=> constants::LOADER_URL,
                'data-media'=>$recordertype,
                'data-appid'=>constants::APPID,
                'data-type'=>$recorderskin,
                'data-width'=>$width,
                'data-height'=>$height,
                'data-updatecontrol'=>$inputname,
                'data-timelimit'=> $timelimit,
                'data-transcode'=>$transcode,
                'data-transcribe'=>$amazontranscribe,
                'data-speechevents'=>$chrometranscribe,
                'data-language'=>$question->language,
                'data-expiredays'=>$question->expiredays,
                'data-region'=>$r_options->awsregion,
                'data-fallback'=>$r_options->fallback,
                'data-hints'=>$string_hints,
                'data-token'=>$token //localhost
                //'data-token'=>"643eba92a1447ac0c6a882c85051461a" //cloudpoodll
            )
        );

        $containerdiv= \html_writer::div($recorderdiv,constants::CLASS_REC_CONTAINER . " ",
            array('id'=>constants::CLASS_REC_CONTAINER . $dom_id));

        //this is the finalhtml
        $recorderhtml = \html_writer::div($containerdiv ,constants::CLASS_REC_OUTER);

        //set up the AMD for the recorder
        $opts = array(
            "component"=> constants::M_COMPONENT,
            "dom_id"=>$dom_id,
            "inputname"=>$inputname
        );

        $this->page->requires->js_call_amd(constants::M_COMPONENT . "/cloudpoodllhelper", 'init', array($opts));
        //$PAGE->requires->strings_for_js(array('reallydeletesubmission'),constants::M_COMPONENT);

        return $recorderhtml;
    }

    protected function class_name() {
        return 'qtype_speakautograde_base';
    }

    public function response_area_read_only($name, $qa, $step, $lines, $context) {
        //this fetches submitted
        $url = $step->get_qt_var($name . 'audiourl');
        $transcript = $step->get_qt_var($name . 'transcript');
        return $this->fetch_player($url) . $this->fetch_transcript($transcript);
    }

    public function response_area_input($name, $qa, $step, $lines, $context) {
        $question = $qa->get_question();
        $options = get_config('qtype_speakautograde') ;


        $inputname = $qa->get_qt_field_name($name);
        //$whatname = $step->get_qt_var($name);
        $therecorder = $this->fetch_recorder($options,$question, $inputname);
        $format_hidden= html_writer::empty_tag('input', array('type' => 'hidden',
            'name' => $inputname . 'format', 'value' => FORMAT_PLAIN));
        $transcript_hidden = html_writer::empty_tag('input', array('type' => 'hidden',
            'name' => $inputname . 'transcript'));
        $audiourl_hidden = html_writer::empty_tag('input', array('type' => 'hidden',
            'name' => $inputname . 'audiourl'));

        //standard answer field
        $answer_hidden = html_writer::empty_tag('input', array('type' => 'hidden',
            'name' => $inputname, 'value'=>'empty'));

        return $therecorder . $format_hidden . $transcript_hidden . $audiourl_hidden . $answer_hidden ;
    }
}

/**
 * An speakautograde format renderer for speakautogrades where the student should record audio.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_speakautograde_format_audio_renderer extends qtype_speakautograde_format_base_renderer {
    protected function class_name() {
        return 'qtype_speakautograde_audio';
    }
}

/**
 * An speakautograde format renderer for speakautogrades where the student should record audio.
 *
 * @copyright  2011 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_speakautograde_format_video_renderer extends qtype_speakautograde_format_base_renderer {
    protected function class_name() {
        return 'qtype_speakautograde_video';
    }
}
