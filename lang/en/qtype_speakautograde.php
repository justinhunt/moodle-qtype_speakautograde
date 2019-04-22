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
 * Strings for component 'qtype_speakautograde', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package    qtype
 * @subpackage speakautograde
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Speak (auto-grade)';
$string['pluginname_help'] = 'In response to a question that may include an image, the respondent speaks an answer of one or more paragraphs. Initially, a grade is awarded automatically based on the number of chars, words, sentences or paragarphs, and the presence of certain target phrases. The automatic grade may be overridden later by the teacher.';
$string['pluginname_link'] = 'question/type/speakautograde';
$string['pluginnameadding'] = 'Adding an Speak (auto-grade) question';
$string['pluginnameediting'] = 'Editing an Speak (auto-grade) question';
$string['pluginnamesummary'] = 'Allows a short speech segment, consisting of several sentences or paragraphs, to be submitted as a question response. The speak is graded automatically. The grade may be overridden later.';

$string['privacy:metadata'] = 'The Speak (auto-grade) question type plugin does not store any personal data.';

// CloudPoodll settings and options
$string['formataudio']="Audio recording";
$string['formatvideo']="Video recording";
$string['formatupload']="Upload media file";

$string['recorder'] = 'Recorder type';
$string['recorderaudio'] = 'Audio recorder';
$string['recordervideo'] = 'Video recorder';
$string['defaultrecorder'] = 'Recorder type';
$string['defaultrecorder_details'] = '';

$string['apiuser'] = 'Poodll API User ';
$string['apiuser_details'] = 'The Poodll account username that authorises Poodll on this site.';
$string['apisecret'] = 'Poodll API Secret ';
$string['apisecret_details'] = 'The Poodll API secret. See <a href= "https://support.poodll.com/support/solutions/articles/19000083076-cloud-poodll-api-secret">here</a> for more details';
$string['language'] = 'Speaker language';

$string['useast1'] = 'US East';
$string['tokyo'] = 'Tokyo, Japan';
$string['sydney'] = 'Sydney, Australia';
$string['dublin'] = 'Dublin, Ireland';
$string['ottawa'] = 'Ottawa, Canada (slow)';
$string['frankfurt'] = 'Frankfurt, Germany (slow)';
$string['london'] = 'London, U.K (slow)';
$string['saopaulo'] = 'Sao Paulo, Brazil (slow)';
$string['forever'] = 'Never expire';
$string['en-us'] = 'English (US)';
$string['es-us'] = 'Spanish (US)';
$string['en-au'] = 'English (Aus.)';
$string['en-uk'] = 'English (UK)';
$string['fr-ca'] = 'French (Can.)';
$string['awsregion'] = 'AWS Region';
$string['region'] = 'AWS Region';
$string['expiredays'] = 'Days to keep file';

$string['timelimit'] = 'Recording time limit';
$string['currentsubmission'] = 'Current Submission:';

$string['recordertype'] = 'Cloud Poodll recording type';
$string['audioskin'] = 'Audio recorder skin';
$string['videoskin'] = 'Video recorder skin';
$string['skinplain'] = 'Plain';
$string['skinbmr'] = 'Burnt Rose';
$string['skinfresh'] = 'Fresh (audio only)';
$string['skin123'] = 'One Two Three';
$string['skinonce'] = 'Once';
$string['skinupload'] = 'Upload';

$string['fallback'] = 'non-HTML5 Fallback';
$string['fallback_details'] = 'If the browser does not support HTML5 recording for the selected mediatype, fallback to an upload screen or a warning.';
$string['fallbackupload'] = 'Upload';
$string['fallbackiosupload'] = 'iOS: upload, else warning';
$string['fallbackwarning'] = 'Warning';

$string['displaysubs'] = '{$a->subscriptionname} : expires {$a->expiredate}';
$string['noapiuser'] = 'No API user entered. Plugin will not work correctly.';
$string['noapisecret'] = 'No API secret entered. Plugin will not work correctly.';
$string['credentialsinvalid'] = 'The API user and secret entered could not be used to get access. Please check them.';
$string['appauthorised']= 'Speak(auto grade) is authorised for this site.';
$string['appnotauthorised']= 'Speak(auto grade) is NOT authorised for this site.';
$string['refreshtoken']= 'Refresh license information';
$string['notokenincache']= 'Refresh to see license information. Contact support if there is a problem.';
$string['transcode']= 'Transcode';
$string['transcode_details']= 'Transcode audio to MP3 and video to MP4.';
$string['transcriber'] = 'Transcriber';
$string['transcriber_details'] = 'The transcription engine to use';
$string['transcriber_amazontranscribe'] = 'Amazon Transcribe';
$string['transcriber_chrome'] = 'Chrome Speech API';
$string['transcriptnotready'] = 'Transcript not ready yet';
$string['transcripttitle'] = 'Transcript';

$string['notimelimit'] = 'No time limit';
$string['xsecs'] = '{$a} seconds';
$string['onemin'] = '1 minute';
$string['xmins'] = '{$a} minutes';
$string['oneminxsecs'] = '1 minutes {$a} seconds';
$string['xminsecs'] = '{$a->minutes} minutes {$a->seconds} seconds';