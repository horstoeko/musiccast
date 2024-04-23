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
    public $id = [];

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
     * @var array
     */
    public $soundProgramList = [];

    /**
     * Available Surround decodes
     *
     * @var array
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
     * @var array
     */
    public $toneControlModeList = [];

    /**
     * Returns selectable settings of Link Controls
     *
     * Values:
     * - standard
     * - stability
     * - speed
     *
     * @var array
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
     * @var array
     */
    public $linkAudioDelayList = [];

    /**
     * Returns ID, min, max, step values of a parameter
     *
     * @var \horstoeko\musiccast\models\MusiccastRangeModel[]
     */
    public $rangeStep = null;

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
     * @var array
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
     * @var array
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
     * @var array
     */
    public $actualVolumeModeList = [];

    /**
     * Undocumented variable
     *
     * @var array
     */
    public $ccsSupported = [];

    /**
     * Returns whether the target Zone is Zone B or not. Valid only when Zone ID is "zone2"
     *
     * @var boolean
     */
    public $zoneB = false;

    /**
     * Get a zone definition by it's id
     *
     * @param string $id
     * @return MusiccastRangeModel|null
     */
    public function getRangeStepById(string $searchForId): ?MusiccastRangeModel
    {
        return array_reduce($this->rangeStep, static function ($carry, MusiccastRangeModel $rangeStep) use ($searchForId) {
            return $carry ?? ($rangeStep->id === $searchForId ? $rangeStep : $carry);
        }, null);
    }
}