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
 *
 *
 * @package   qtype_speakautograde
 * @copyright 2018 Justin Hunt {@link http://www.poodll.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


namespace qtype_speakautograde\cloudpoodll;

defined('MOODLE_INTERNAL') || die();

class constants {
    const M_COMPONENT='qtype_speakautograde';

    const APPID='qtype_speakautograde';

    const REC_AUDIO = 'audio';
    const REC_VIDEO = 'video';

    const SKIN_PLAIN = 'standard';
    const SKIN_BMR = 'bmr';
    const SKIN_123 = 'onetwothree';
    const SKIN_FRESH = 'fresh';
    const SKIN_ONCE = 'once';
    const SKIN_UPLOAD = 'upload';
    const SKIN_PUSH = 'push';

    const FALLBACK_UPLOAD = 'upload';
    const FALLBACK_IOSUPLOAD = 'iosupload';
    const FALLBACK_WARNING = 'warning';

    const TRANSCRIBER_CHROME = 'chrome';
    const TRANSCRIBER_AMAZON_TRANSCRIBE = 'amazontranscribe';
    const PROCESSING = 'processing';
    const BLANK = 'empty';

    const CLASS_REC_CONTAINER ='speakautograde_cloudpoodll_rec_cont';
    const CLASS_REC_OUTER ='speakautograde_cloudpoodll_rec_outer';
    const ID_REC ='speakautograde_cloudpoodll_therecorder';
    const ID_UPDATE_CONTROL ='speakautograde_cloudpoodll_updatecontrol';
    const NAME_UPDATE_CONTROL ='filename';

    const REGION_USEAST1 = 'useast1';
    const REGION_TOKYO = 'tokyo';
    const REGION_DUBLIN = 'dublin';
    const REGION_SYDNEY = 'sydney';
    const REGION_OTTAWA = 'ottawa';
    const REGION_SAOPAULO = 'saopaulo';
    const REGION_FRANKFURT = 'frankfurt';
    const REGION_LONDON = 'london';

    const LOADER_URL ='/question/type/speakautograde/cloudpoodll/cloudpoodllloader.html';
    const REFRESH_URL = '/question/type/speakautograde/cloudpoodll/refreshtoken.php';
}