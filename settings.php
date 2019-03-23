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
 * This file defines the admin settings for this plugin
 *
 * @package   qtype_speakautograde
 * @copyright 2012 Justin Hunt {@link http://www.poodll.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


use qtype_speakautograde\cloudpoodll\constants;
use qtype_speakautograde\cloudpoodll\utils;

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

$settings->add(new admin_setting_configtext(constants::M_COMPONENT .'/apiuser',
    get_string('apiuser', constants::M_COMPONENT), get_string('apiuser_details', constants::M_COMPONENT), '', PARAM_TEXT));

$tokeninfo =   utils::fetch_token_for_display(get_config(constants::M_COMPONENT,'apiuser'),get_config(constants::M_COMPONENT,'apisecret'));
//get_string('apisecret_details', constants::M_COMPONENT)
$settings->add(new admin_setting_configtext(constants::M_COMPONENT .'/apisecret',
    get_string('apisecret', constants::M_COMPONENT), $tokeninfo, '', PARAM_TEXT));

$regions = utils::get_region_options();
$settings->add(new admin_setting_configselect(constants::M_COMPONENT .'/awsregion', get_string('awsregion', constants::M_COMPONENT),
    '', constants::REGION_USEAST1, $regions));

$expiredays = utils::get_expiredays_options();
$settings->add(new admin_setting_configselect(constants::M_COMPONENT .'/expiredays', get_string('expiredays', constants::M_COMPONENT), '', '365', $expiredays));

$langoptions = utils::get_lang_options();
$settings->add(new admin_setting_configselect(constants::M_COMPONENT .'/language', get_string('language', constants::M_COMPONENT), '', 'en-US', $langoptions));



    //Default recorder skins
    $skin_options = utils::fetch_options_skins(constants::REC_AUDIO);
    $settings->add(new admin_setting_configselect(constants::M_COMPONENT .'/audioskin',
        new lang_string('audioskin', constants::M_COMPONENT),
        new lang_string('audioskin', constants::M_COMPONENT), constants::SKIN_123, $skin_options));

    $skin_options = utils::fetch_options_skins(constants::REC_VIDEO);
    $settings->add(new admin_setting_configselect(constants::M_COMPONENT .'/videoskin',
        new lang_string('videoskin', constants::M_COMPONENT),
        new lang_string('videoskin', constants::M_COMPONENT), constants::SKIN_123, $skin_options));

    //transcriber options
    $transcriber_options = utils::fetch_options_transcribers();
    $settings->add(new admin_setting_configselect(constants::M_COMPONENT .'/transcriber',
        new lang_string('transcriber', constants::M_COMPONENT),
        new lang_string('transcriber_details', constants::M_COMPONENT), constants::TRANSCRIBER_CHROME, $transcriber_options));

    //Transcode audio/video
    $yesno_options = array( 0 => get_string("no", constants::M_COMPONENT),
        1 => get_string("yes", constants::M_COMPONENT));
    $settings->add(new admin_setting_configselect(constants::M_COMPONENT .'/transcode',
        new lang_string('transcode', constants::M_COMPONENT),
        new lang_string('transcode_details', constants::M_COMPONENT), 1, $yesno_options));

//Default html5 fallback
    $fallback_options = utils::fetch_options_fallback();
    $settings->add(new admin_setting_configselect(constants::M_COMPONENT .'/fallback',
        new lang_string('fallback', constants::M_COMPONENT),
        new lang_string('fallbackdetails', constants::M_COMPONENT), constants::FALLBACK_IOSUPLOAD, $fallback_options));

}