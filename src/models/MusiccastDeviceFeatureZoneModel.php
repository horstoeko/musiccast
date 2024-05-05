<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the device feature (for the system.zone)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureZoneModel extends MusiccastBaseModel
{
    /**
     * ID
     *
     * @var string
     */
    public $id = "";

    /**
     * Returns whether the target Zone is Zone B or not. Valid only when Zone ID is "zone2"
     *
     * @var boolean
     */
    public $zoneB = false;

    /**
     * Functions possible
     *
     * @var string[]
     */
    public $funcList = [];

    /**
     * Available inputes
     *
     * @var string[]
     */
    public $inputList = [];

    /**
     * Available sound programs
     *
     * @var string[]
     */
    public $soundProgramList = [];

    /**
     * Available Surround decodes
     *
     * @var string[]
     */
    public $surrDecoderTypeList = [];

    /**
     * Returns selectable settings of Tone Control Mode. If there’s no list of this, it’s fixed to "manual"
     *
     * Values:
     * - manual
     * - auto
     * - bypas
     *
     * @var string[]
     */
    public $toneControlModeList = [];

    /**
     * Returns selectable settings of Equalizer Mode.
     * If there’s not list of this, it’s fixed to “manual”
     *
     * @var string[]
     */
    public $equalizerModeList = [];

    /**
     * Returns selectable settings of Link Controls
     *
     * Values:
     * - standard
     * - stability
     * - speed
     *
     * @var string[]
     */
    public $linkControlList = [];

    /**
     * Returns selectable settings of Link Audio Delay
     *
     * Values:
     * - lip_sync
     * - audio_sync
     * - audio_sync_on
     * - audio_sync_off
     * - balanced
     *
     * @var string[]
     */
    public $linkAudioDelayList = [];

    /**
     * Returns selectable settings of Link Audio Quality
     *
     * Values:
     * - compressed
     * - uncompressed
     *
     * @var string[]
     */
    public $linkAudioQualityList = [];

    /**
     * Returns ID, min, max, step values of a parameter
     *
     * @var \horstoeko\musiccast\models\MusiccastDeviceFeatureRangeModel[]
     */
    public $rangeStep = [];

    /**
     * Returns selectable scenes of total number. This parameter does not exist in models without a scene
     *
     * @var integer
     */
    public $sceneNum = 0;

    /**
     * Returns functions available with executeCursor of remote control function.
     * This parameter does not exist in models without a function
     *
     * Values:
     * - up
     * - down
     * - left
     * - right
     * - select
     * - return
     *
     * @var string[]
     */
    public $cursorList = [];

    /**
     * Returns functions available with executeMenu of remote control function.
     * This parameter does not exist in models without a function
     *
     * Values:
     * - on_screen
     * - top_menu
     * - menu
     * - option
     * - display
     * - help
     * - home
     * - mode
     * - red
     * - green
     * - yellow
     * - "blue"
     *
     * @var string[]
     */
    public $menuList = [];

    /**
     * Returns function list of configurable Actual Volume Mode
     * This parameter does not exist in models without a function
     *
     * Values:
     * - db
     * - numeric
     *
     * _Note:_ For models fixed to "db", the value is "db" only
     *
     * @var string[]
     */
    public $actualVolumeModeList = [];

    /**
     * Returns function list of configurable Audio Select.
     * This parameter does not exist in models without a function
     *
     * Values:
     * - auto
     * - hdmi
     * - coax_opt
     * - analog
     * - unavailabl
     *
     * @var string[]
     */
    public $audioSelectList = [];

    /**
     * Undocumented variable
     *
     * @var string[]
     */
    public $ccsSupported = [];

    /**
     * Get a zone definition by it's id
     *
     * @param  string $searchForId
     * @return MusiccastDeviceFeatureRangeModel|null
     */
    public function getRangeStepById(string $searchForId): ?MusiccastDeviceFeatureRangeModel
    {
        return array_reduce(
            $this->rangeStep, static function ($carry, MusiccastDeviceFeatureRangeModel $rangeStep) use ($searchForId) {
                return $carry ?? ($rangeStep->id === $searchForId ? $rangeStep : $carry);
            }, null
        );
    }
}
