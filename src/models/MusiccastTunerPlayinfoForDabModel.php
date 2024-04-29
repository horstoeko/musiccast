<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the tuner am-band playback info model
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastTunerPlayinfoForDabModel extends MusiccastBaseModel
{
    /**
     * Returns current preset number. 0 when there’s no presets
     * Values: 0 (no presets), or one in the range gotten via /system/getFeatures
     *
     * @var integer
     */
    public $preset = 0;

    /**
     * Station ID
     *
     * @var integer
     */
    public $id = 0;

    /**
     * eturns DAB status. When it’s in Tune Aid, valid parameters are "tune_aid" and "CH Label" only
     *
     * Values:
     * - not_ready
     * - initial_scan
     * - tune_aid
     * - ready
     *
     * @var string
     */
    public $status = "";

    /**
     * DAB frequency (unit in kHz)
     *
     * Value Range: 174000 - 240000
     *
     * @var integer
     */
    public $freq = 0;

    /**
     * Category
     *
     * Values:
     * - primary
     * - secondary
     *
     * @var string
     */
    public $category = "";

    /**
     * Audio Mode
     *
     * Values:
     * - mono
     * - stereo
     *
     * @var string
     */
    public $audioMode = "";

    /**
     * Audio bitrate (unit in kbps)
     *
     * Value Range: 32 ~ 256
     *
     * @var integer
     */
    public $bitRate = 0;

    /**
     * Returns signal quality level
     *
     * Value Range: 0 - 100
     *
     * @var integer
     */
    public $quality = 0;

    /**
     * Returns signal strength level
     *
     * Value Range: 0 - 100
     *
     * @var integer
     */
    public $tuneAid = 0;

    /**
     * Off Air statu
     *
     * @var boolean
     */
    public $offAir = false;

    /**
     * DAB+ status
     *
     * @var boolean
     */
    public $dabPlus = false;

    /**
     * Program Type
     *
     * @var string
     */
    public $programType = "";

    /**
     * CH Label
     *
     * @var string
     */
    public $chLabel = "";

    /**
     * Service Label
     *
     * @var string
     */
    public $serviceLabel = "";

    /**
     * DLS
     *
     * @var string
     */
    public $dls = "";

    /**
     * Ensemble Labe
     *
     * @var string
     */
    public $ensembleLabel = "";

    /**
     * Returns Initial Scan progress status. Available only when "dab_initial_scan" exists in tuner - func_list under /system/getFeatures
     *
     * Value Range: 0 - 100
     *
     * @var integer
     */
    public $initialScanProgress = 0;

    /**
     * Returns station numbers detected by Initial Scan. Available only when "dab_initial_scan" exists in tuner - func_list under /system/getFeatures
     * 0 if Initial Scan hasn’t executed or nothing found
     *
     * Value Range: 0 - 255
     *
     * @var integer
     */
    public $totalStationNum = 0;
}