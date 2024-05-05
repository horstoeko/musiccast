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
use horstoeko\musiccast\models\MusiccastNetUsbPlaybackModel;
use horstoeko\musiccast\models\MusiccastNetUsbPlayinfoModel;
use horstoeko\musiccast\models\MusiccastNetUsbPresetInfoModel;
use horstoeko\musiccast\models\MusiccastNetUsbPlayPositionModel;
use horstoeko\musiccast\models\MusiccastNetUsbRecallPresetModel;

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
            ], $newPlayback
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
}
