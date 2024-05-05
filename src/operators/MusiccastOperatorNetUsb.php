<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\operators;

use horstoeko\musiccast\MusiccastConnection;
use horstoeko\musiccast\utils\MusiccastConstants;
use horstoeko\musiccast\utils\MusiccastValidation;
use horstoeko\musiccast\models\MusiccastNetUsbRepeatModel;
use horstoeko\musiccast\models\MusiccastNetUsbQualityModel;
use horstoeko\musiccast\models\MusiccastNetUsbShuffleModel;
use horstoeko\musiccast\models\MusiccastNetUsbPlaybackModel;
use horstoeko\musiccast\models\MusiccastNetUsbPlayinfoModel;
use horstoeko\musiccast\models\MusiccastNetUsbSettingsModel;
use horstoeko\musiccast\models\MusiccastNetUsbMovePresetModel;
use horstoeko\musiccast\models\MusiccastNetUsbPresetInfoModel;
use horstoeko\musiccast\models\MusiccastNetUsbRecentInfoModel;
use horstoeko\musiccast\models\MusiccastNetUsbClearPresetModel;
use horstoeko\musiccast\models\MusiccastNetUsbRecallRecentItem;
use horstoeko\musiccast\models\MusiccastNetUsbStorePresetModel;
use horstoeko\musiccast\models\MusiccastNetUsbPlayPositionModel;
use horstoeko\musiccast\models\MusiccastNetUsbRecallPresetModel;
use horstoeko\musiccast\models\MusiccastNetUsbClearRecentInfoModel;

/**
 * Class representing the base operator
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastOperatorNetUsb extends MusiccastOperatorBase
{
    /**
     * Musiccast System Operator
     *
     * @var MusiccastOperatorSystem;
     */
    protected $musiccastOperatorSystem = null;

    /**
     * Constructor
     *
     * @param MusiccastConnection $musiccastConnection
     */
    public function __construct(MusiccastConnection $musiccastConnection)
    {
        parent::__construct($musiccastConnection);

        $this->musiccastOperatorSystem = new MusiccastOperatorSystem($musiccastConnection);
    }

    /**
     * Get tuner presets
     *
     * @return MusiccastNetUsbPresetInfoModel
     */
    public function getPresets(): MusiccastNetUsbPresetInfoModel
    {
        $responseObject = $this->musiccastConnection->requestGet("netusb/getPresetInfo", MusiccastNetUsbPresetInfoModel::class);

        return $responseObject;
    }

    /**
     * Retrieve playback information
     *
     * @return MusiccastNetUsbPlayinfoModel
     */
    public function getPlayInfo(): MusiccastNetUsbPlayinfoModel
    {
        $responseObject = $this->musiccastConnection->requestGet("netusb/getPlayInfo", MusiccastNetUsbPlayinfoModel::class);

        return $responseObject;
    }

    /**
     * Internal helper for playback methods
     *
     * @param  string $newPlayback
     * @return MusiccastNetUsbPlaybackModel
     */
    private function internalSetPlayback(string $newPlayback): MusiccastNetUsbPlaybackModel
    {
        MusiccastValidation::testInArray(
            [
                MusiccastConstants::NETUSB_PLAY,
                MusiccastConstants::NETUSB_STOP,
                MusiccastConstants::NETUSB_PAUSE,
                MusiccastConstants::NETUSB_PLAY_PAUSE,
                MusiccastConstants::NETUSB_PREVIOUS,
                MusiccastConstants::NETUSB_NEXT,
                MusiccastConstants::NETUSB_FAST_REVERSE_START,
                MusiccastConstants::NETUSB_FAST_REVERSE_END,
                MusiccastConstants::NETUSB_FAST_FORWARD_START,
                MusiccastConstants::NETUSB_FAST_FORWARD_END,
            ],
            $newPlayback
        );

        $responseObject = $this->musiccastConnection->requestGet("netusb/setPlayback?playback=$newPlayback", MusiccastNetUsbPlayinfoModel::class);

        return $responseObject;
    }

    /**
     * Start playing
     *
     * @return MusiccastNetUsbPlaybackModel
     */
    public function setPlaybackToPlay(): MusiccastNetUsbPlaybackModel
    {
        return $this->internalSetPlayback(MusiccastConstants::NETUSB_PLAY);
    }

    /**
     * Stop playing
     *
     * @return MusiccastNetUsbPlaybackModel
     */
    public function setPlaybackToStop(): MusiccastNetUsbPlaybackModel
    {
        return $this->internalSetPlayback(MusiccastConstants::NETUSB_STOP);
    }

    /**
     * Pause playing
     *
     * @return MusiccastNetUsbPlaybackModel
     */
    public function setPlaybackToPause(): MusiccastNetUsbPlaybackModel
    {
        return $this->internalSetPlayback(MusiccastConstants::NETUSB_PAUSE);
    }

    /**
     * Play Pause
     *
     * @return MusiccastNetUsbPlaybackModel
     */
    public function setPlaybackToPlayPause(): MusiccastNetUsbPlaybackModel
    {
        return $this->internalSetPlayback(MusiccastConstants::NETUSB_PLAY_PAUSE);
    }

    /**
     * Play next track
     *
     * @return MusiccastNetUsbPlaybackModel
     */
    public function setPlaybackToNext(): MusiccastNetUsbPlaybackModel
    {
        return $this->internalSetPlayback(MusiccastConstants::NETUSB_NEXT);
    }

    /**
     * Play Previous track
     *
     * @return MusiccastNetUsbPlaybackModel
     */
    public function setPlaybackToPrevious(): MusiccastNetUsbPlaybackModel
    {
        return $this->internalSetPlayback(MusiccastConstants::NETUSB_PREVIOUS);
    }

    /**
     * Begin FastForward playing
     *
     * @return MusiccastNetUsbPlaybackModel
     */
    public function setPlaybackToFastForwardStart(): MusiccastNetUsbPlaybackModel
    {
        return $this->internalSetPlayback(MusiccastConstants::NETUSB_FAST_FORWARD_START);
    }

    /**
     * End FastForward playing
     *
     * @return MusiccastNetUsbPlaybackModel
     */
    public function setPlaybackToFastForwardEnd(): MusiccastNetUsbPlaybackModel
    {
        return $this->internalSetPlayback(MusiccastConstants::NETUSB_FAST_FORWARD_END);
    }

    /**
     * Begin FastReverse playing
     *
     * @return MusiccastNetUsbPlaybackModel
     */
    public function setPlaybackToFastReverseStart(): MusiccastNetUsbPlaybackModel
    {
        return $this->internalSetPlayback(MusiccastConstants::NETUSB_FAST_REVERSE_START);
    }

    /**
     * End FastReverse playing
     *
     * @return MusiccastNetUsbPlaybackModel
     */
    public function setPlaybackToFastReverseEnd(): MusiccastNetUsbPlaybackModel
    {
        return $this->internalSetPlayback(MusiccastConstants::NETUSB_FAST_REVERSE_END);
    }

    /**
     * Setting track play positio
     *
     * @param  integer $newPosition Specifies play position (sec) Value : no fewer than total_time gotten via getPlayInfo, nor more than 0
     * @return MusiccastNetUsbPlayPositionModel
     */
    public function setPlayPosition(int $newPosition): MusiccastNetUsbPlayPositionModel
    {
        $playInfo = $this->getPlayInfo();

        MusiccastValidation::testIntValueBetween($newPosition, 0, $playInfo->totalTime);

        $responseObject = $this->musiccastConnection->requestGet("netusb/setPlayPosition?position=$newPosition", MusiccastNetUsbPlayPositionModel::class);

        return $responseObject;
    }

    /**
     * Internal helper method for setting up the repeat mode
     *
     * @param  string $newMode
     * @return MusiccastNetUsbRepeatModel
     */
    private function internalSetRepeat(string $newMode): MusiccastNetUsbRepeatModel
    {
        MusiccastValidation::testInArray(
            [
                MusiccastConstants::NETUSB_REPEAT_OFF,
                MusiccastConstants::NETUSB_REPEAT_ONE,
                MusiccastConstants::NETUSB_REPEAT_ALL,
            ],
            $newMode
        );

        $responseObject = $this->musiccastConnection->requestGet("netusb/setRepeat?mode=$newMode", MusiccastNetUsbRepeatModel::class);

        return $responseObject;
    }

    /**
     * Set repeat mode off
     *
     * @return MusiccastNetUsbRepeatModel
     */
    public function setRepeatOff(): MusiccastNetUsbRepeatModel
    {
        return $this->internalSetRepeat(MusiccastConstants::NETUSB_REPEAT_OFF);
    }

    /**
     * Set repeat mode to "one"
     *
     * @return MusiccastNetUsbRepeatModel
     */
    public function setRepeatOne(): MusiccastNetUsbRepeatModel
    {
        return $this->internalSetRepeat(MusiccastConstants::NETUSB_REPEAT_ONE);
    }

    /**
     * Set repeat mode to "all"
     *
     * @return MusiccastNetUsbRepeatModel
     */
    public function setRepeatAll(): MusiccastNetUsbRepeatModel
    {
        return $this->internalSetRepeat(MusiccastConstants::NETUSB_REPEAT_ALL);
    }

    /**
     * Toggling repeat setting. No direct/discrete setting commands available
     *
     * @return MusiccastNetUsbRepeatModel
     */
    public function toggleRepeat(): MusiccastNetUsbRepeatModel
    {
        $responseObject = $this->musiccastConnection->requestGet("netusb/toggleRepeat", MusiccastNetUsbRepeatModel::class);

        return $responseObject;
    }

    /**
     * Internal helper method for setting up the shuffle mode
     *
     * @param  string $newMode
     * @return MusiccastNetUsbShuffleModel
     */
    private function internalSetShuffle(string $newMode): MusiccastNetUsbShuffleModel
    {
        MusiccastValidation::testInArray(
            [
                MusiccastConstants::NETUSB_SHUFFLE_OFF,
                MusiccastConstants::NETUSB_SHUFFLE_ON,
                MusiccastConstants::NETUSB_SHUFFLE_SONGS,
                MusiccastConstants::NETUSB_SHUFFLE_ALBUMS,
            ],
            $newMode
        );

        $responseObject = $this->musiccastConnection->requestGet("netusb/setShuffle?mode=$newMode", MusiccastNetUsbShuffleModel::class);

        return $responseObject;
    }

    /**
     * Set shuffle mode to off
     *
     * @return MusiccastNetUsbShuffleModel
     */
    public function setShuffleOff(): MusiccastNetUsbShuffleModel
    {
        return $this->internalSetShuffle(MusiccastConstants::NETUSB_SHUFFLE_OFF);
    }

    /**
     * Set shuffle mode to on
     *
     * @return MusiccastNetUsbShuffleModel
     */
    public function setShuffleOn(): MusiccastNetUsbShuffleModel
    {
        return $this->internalSetShuffle(MusiccastConstants::NETUSB_SHUFFLE_ON);
    }

    /**
     * Set shuffle mode to "songs"
     *
     * @return MusiccastNetUsbShuffleModel
     */
    public function setShuffleSongs(): MusiccastNetUsbShuffleModel
    {
        return $this->internalSetShuffle(MusiccastConstants::NETUSB_SHUFFLE_SONGS);
    }

    /**
     * Set shuffle mode to "albums"
     *
     * @return MusiccastNetUsbShuffleModel
     */
    public function setShuffleAlbums(): MusiccastNetUsbShuffleModel
    {
        return $this->internalSetShuffle(MusiccastConstants::NETUSB_SHUFFLE_ALBUMS);
    }

    /**
     * Toggling shuffle setting. No direct / discrete setting commands available
     *
     * @return MusiccastNetUsbRepeatModel
     */
    public function toggleShuffle(): MusiccastNetUsbRepeatModel
    {
        $responseObject = $this->musiccastConnection->requestGet("netusb/toggleShuffle", MusiccastNetUsbRepeatModel::class);

        return $responseObject;
    }

    /**
     * Recall a tuner preset
     *
     * @param  string  $newBand
     * @param  integer $newNumber
     * @return MusiccastNetUsbRecallPresetModel
     */
    public function recallPreset(int $newNumber): MusiccastNetUsbRecallPresetModel
    {
        $deviceFeature = $this->musiccastOperatorSystem->getDeviceFeatures();

        MusiccastValidation::testIntValueBetween($newNumber, 1, $deviceFeature->netusb->preset->num);

        $responseObject = $this->musiccastConnection->requestGet("netusb/recallPreset?zone={$this->musiccastConnection->getZone()}&num={$newNumber}", MusiccastNetUsbRecallPresetModel::class);

        return $responseObject;
    }

    /**
     * Register current content to a preset. Presets are common use among Net/USB related
     * input sources. Comfirm the result whether register to a preset or not via netusb |- preset_control
     *
     * @param  integer $newNumber
     * Specifying a preset number, Value: one in the range gotten via /system/getFeatures
     * @return MusiccastNetUsbStorePresetModel
     */
    public function storePreset(int $newNumber): MusiccastNetUsbStorePresetModel
    {
        $deviceFeature = $this->musiccastOperatorSystem->getDeviceFeatures();

        MusiccastValidation::testIntValueBetween($newNumber, 1, $deviceFeature->netusb->preset->num);

        $responseObject = $this->musiccastConnection->requestGet("netusb/storePreset?num={$newNumber}", MusiccastNetUsbStorePresetModel::class);

        return $responseObject;
    }

    /**
     * Clear a presets
     *
     * @param  integer $newNumber
     * Specifying a preset number, Value: one in the range gotten via /system/getFeatures
     * @return MusiccastNetUsbClearPresetModel
     */
    public function clearPreset(int $newNumber): MusiccastNetUsbClearPresetModel
    {
        $deviceFeature = $this->musiccastOperatorSystem->getDeviceFeatures();

        MusiccastValidation::testIntValueBetween($newNumber, 1, $deviceFeature->netusb->preset->num);

        $responseObject = $this->musiccastConnection->requestGet("netusb/clearPreset?num={$newNumber}", MusiccastNetUsbClearPresetModel::class);

        return $responseObject;
    }

    /**
     * Move a preset
     * For example, if excute movePreset?from=4&to=2 for list {[A], [B], [C], [D], [E] ...}, list is
     * arranged as {[A], [D], [B], [C], [E] ...}.
     *
     * @param  integer $fromNumber
     * Specifies source preset number, Values: one in the range gotten via /system/getFeatures
     * @param  integer $toNumber
     * Specifies destination preset number, Values: one in the range gotten via /system/getFeatures
     * @return MusiccastNetUsbMovePresetModel
     */
    public function movePreset(int $fromNumber, int $toNumber): MusiccastNetUsbMovePresetModel
    {
        $deviceFeature = $this->musiccastOperatorSystem->getDeviceFeatures();

        MusiccastValidation::testIntValueBetween($fromNumber, 1, $deviceFeature->netusb->preset->num);
        MusiccastValidation::testIntValueBetween($toNumber, 1, $deviceFeature->netusb->preset->num);

        $responseObject = $this->musiccastConnection->requestGet("netusb/movePreset?from={$fromNumber}&to={$toNumber}", MusiccastNetUsbMovePresetModel::class);

        return $responseObject;
    }

    /**
     * Retrieve setup of Net/USB
     *
     * @return MusiccastNetUsbSettingsModel
     */
    public function getSettings(): MusiccastNetUsbSettingsModel
    {
        $responseObject = $this->musiccastConnection->requestGet("netusb/getSettings", MusiccastNetUsbSettingsModel::class);

        return $responseObject;
    }

    /**
     * setting the reproduction quality of streaming. Refer to available Input/setting value via /netusb/getSetting.
     *
     * @param  string $newQuality
     * @return MusiccastNetUsbQualityModel
     */
    public function setQuality(string $newQuality): MusiccastNetUsbQualityModel
    {
        MusiccastValidation::testInArray($this->getSettings()->qobuz->quality->getAllowedQualities(), $newQuality);

        $responseObject = $this->musiccastConnection->requestGet("netusb/getSettings", MusiccastNetUsbQualityModel::class);

        return $responseObject;
    }

    /**
     * Retrieve playback history. History is shared among all Net/USB Input sources
     *
     * @return MusiccastNetUsbRecentInfoModel
     */
    public function getRecentInfo(): MusiccastNetUsbRecentInfoModel
    {
        $responseObject = $this->musiccastConnection->requestGet("netusb/getRecentInfo", MusiccastNetUsbRecentInfoModel::class);

        return $responseObject;
    }

    /**
     * Recall a content via playback history
     *
     * @param  integer $newNumber
     * @return MusiccastNetUsbRecallRecentItem
     */
    public function recallRecentItem(int $newNumber): MusiccastNetUsbRecallRecentItem
    {
        $deviceFeature = $this->musiccastOperatorSystem->getDeviceFeatures();

        MusiccastValidation::testIntValueBetween($newNumber, 1, $deviceFeature->netusb->preset->num);

        $recentInfo = $this->getRecentInfo();

        MusiccastValidation::testIntValueBetween($newNumber, 1, count($recentInfo->recentInfo));

        $responseObject = $this->musiccastConnection->requestGet("netusb/recallRecentItem?zone={$this->musiccastConnection->getZone()}&num={$newNumber}", MusiccastNetUsbRecallRecentItem::class);

        return $responseObject;
    }

    /**
     * Clear all recent history information
     *
     * @return MusiccastNetUsbClearRecentInfoModel
     */
    public function clearRecentInfo(): MusiccastNetUsbClearRecentInfoModel
    {
        $responseObject = $this->musiccastConnection->requestGet("netusb/clearRecentInfo", MusiccastNetUsbClearRecentInfoModel::class);

        return $responseObject;
    }
}
