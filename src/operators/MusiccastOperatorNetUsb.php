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
use horstoeko\musiccast\models\MusiccastNetUsbListInfoModel;
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
use horstoeko\musiccast\models\MusiccastNetUsbSetListControlModel;
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
    protected $musiccastOperatorSystem;

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
        return $this->musiccastConnection->requestGet("netusb/getPresetInfo", MusiccastNetUsbPresetInfoModel::class);
    }

    /**
     * Retrieve playback information
     *
     * @return MusiccastNetUsbPlayinfoModel
     */
    public function getPlayInfo(): MusiccastNetUsbPlayinfoModel
    {
        return $this->musiccastConnection->requestGet("netusb/getPlayInfo", MusiccastNetUsbPlayinfoModel::class);
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

        return $this->musiccastConnection->requestGet('netusb/setPlayback?playback=' . $newPlayback, MusiccastNetUsbPlayinfoModel::class);
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

        return $this->musiccastConnection->requestGet('netusb/setPlayPosition?position=' . $newPosition, MusiccastNetUsbPlayPositionModel::class);
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

        return $this->musiccastConnection->requestGet('netusb/setRepeat?mode=' . $newMode, MusiccastNetUsbRepeatModel::class);
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
        return $this->musiccastConnection->requestGet("netusb/toggleRepeat", MusiccastNetUsbRepeatModel::class);
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

        return $this->musiccastConnection->requestGet('netusb/setShuffle?mode=' . $newMode, MusiccastNetUsbShuffleModel::class);
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
        return $this->musiccastConnection->requestGet("netusb/toggleShuffle", MusiccastNetUsbRepeatModel::class);
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

        return $this->musiccastConnection->requestGet(sprintf('netusb/recallPreset?zone=%s&num=%d', $this->musiccastConnection->getZone(), $newNumber), MusiccastNetUsbRecallPresetModel::class);
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

        return $this->musiccastConnection->requestGet('netusb/storePreset?num=' . $newNumber, MusiccastNetUsbStorePresetModel::class);
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

        return $this->musiccastConnection->requestGet('netusb/clearPreset?num=' . $newNumber, MusiccastNetUsbClearPresetModel::class);
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

        return $this->musiccastConnection->requestGet(sprintf('netusb/movePreset?from=%d&to=%d', $fromNumber, $toNumber), MusiccastNetUsbMovePresetModel::class);
    }

    /**
     * Retrieve setup of Net/USB
     *
     * @return MusiccastNetUsbSettingsModel
     */
    public function getSettings(): MusiccastNetUsbSettingsModel
    {
        return $this->musiccastConnection->requestGet("netusb/getSettings", MusiccastNetUsbSettingsModel::class);
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

        return $this->musiccastConnection->requestGet("netusb/getSettings", MusiccastNetUsbQualityModel::class);
    }

    /**
     * Retrieve playback history. History is shared among all Net/USB Input sources
     *
     * @return MusiccastNetUsbRecentInfoModel
     */
    public function getRecentInfo(): MusiccastNetUsbRecentInfoModel
    {
        return $this->musiccastConnection->requestGet("netusb/getRecentInfo", MusiccastNetUsbRecentInfoModel::class);
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

        return $this->musiccastConnection->requestGet(sprintf('netusb/recallRecentItem?zone=%s&num=%d', $this->musiccastConnection->getZone(), $newNumber), MusiccastNetUsbRecallRecentItem::class);
    }

    /**
     * Clear all recent history information
     *
     * @return MusiccastNetUsbClearRecentInfoModel
     */
    public function clearRecentInfo(): MusiccastNetUsbClearRecentInfoModel
    {
        return $this->musiccastConnection->requestGet("netusb/clearRecentInfo", MusiccastNetUsbClearRecentInfoModel::class);
    }

    /**
     * Retrieve list information. Basically this info is available to all relevant inputs, not limited to
     * or independent from current input
     *
     * @param  string  $newInput
     * @param  integer $newIndex
     * @param  integer $newSize
     * @return MusiccastNetUsbListInfoModel
     */
    public function getListInfo(string $newInput, int $newIndex = 0, int $newSize = 8): MusiccastNetUsbListInfoModel
    {
        $deviceFeature = $this->musiccastOperatorSystem->getDeviceFeatures();

        MusiccastValidation::testInArray($deviceFeature->system->getInputIdsForNetUsb(), $newInput);
        MusiccastValidation::testIntValueBetween($newSize, 1, 8);

        return $this->musiccastConnection->requestGet(sprintf('netusb/getListInfo?input=%s&index=%d&size=%d', $newInput, $newIndex, $newSize), MusiccastNetUsbListInfoModel::class);
    }

    /**
     * Helper method to Control a list. Controllable list info is not limited to or independent from current in
     *
     * @param  string  $newType
     * @param  integer $newIndex
     * @return MusiccastNetUsbSetListControlModel
     */
    private function internalSetListControl(string $newType, int $newIndex): MusiccastNetUsbSetListControlModel
    {
        MusiccastValidation::testInArray(
            [
            MusiccastConstants::NETUSB_SETLISTCTRL_PLAY,
            MusiccastConstants::NETUSB_SETLISTCTRL_RETURN,
            MusiccastConstants::NETUSB_SETLISTCTRL_SELECT,
            ], $newType
        );

        switch ($newType) {
        case MusiccastConstants::NETUSB_SETLISTCTRL_SELECT:
        case MusiccastConstants::NETUSB_SETLISTCTRL_PLAY:
            $responseObject = $this->musiccastConnection->requestGet(sprintf('netusb/setListControl?type=%s&index=%d', $newType, $newIndex), MusiccastNetUsbSetListControlModel::class);
            break;
        case MusiccastConstants::NETUSB_SETLISTCTRL_RETURN:
            $responseObject = $this->musiccastConnection->requestGet('netusb/setListControl?type=' . $newType, MusiccastNetUsbSetListControlModel::class);
            break;
        }

        return $responseObject;
    }

    /**
     * Select a list item
     *
     * @param  integer $newIndex
     * @return MusiccastNetUsbSetListControlModel
     */
    public function setListControlSelect(int $newIndex): MusiccastNetUsbSetListControlModel
    {
        return $this->internalSetListControl(MusiccastConstants::NETUSB_SETLISTCTRL_SELECT, $newIndex);
    }

    /**
     * Play a list item
     *
     * @param  integer $newIndex
     * @return MusiccastNetUsbSetListControlModel
     */
    public function setListControlPlay(int $newIndex): MusiccastNetUsbSetListControlModel
    {
        return $this->internalSetListControl(MusiccastConstants::NETUSB_SETLISTCTRL_PLAY, $newIndex);
    }

    /**
     * Return to parent list level
     *
     * @param  integer $newIndex
     * @return MusiccastNetUsbSetListControlModel
     */
    public function setListControlReturn(): MusiccastNetUsbSetListControlModel
    {
        return $this->internalSetListControl(MusiccastConstants::NETUSB_SETLISTCTRL_RETURN, -1);
    }
}
