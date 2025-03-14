<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\operators;

use horstoeko\musiccast\models\MusiccastTunerPlayinfoModel;
use horstoeko\musiccast\MusiccastConnection;
use horstoeko\musiccast\utils\MusiccastConstants;
use horstoeko\musiccast\utils\MusiccastValidation;
use horstoeko\musiccast\models\MusiccastTunerSetBandModel;
use horstoeko\musiccast\models\MusiccastTunerSetFreqModel;
use horstoeko\musiccast\models\MusiccastTunerPresetInfoModel;
use horstoeko\musiccast\models\MusiccastTunerRecallPresetModel;

/**
 * Class representing the base operator
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastOperatorTuner extends MusiccastOperatorBase
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
     * @param  string $newBand
     * @return MusiccastTunerPresetInfoModel
     */
    public function getPresets(string $newBand): MusiccastTunerPresetInfoModel
    {
        MusiccastValidation::testInArray(
            [
            MusiccastConstants::TUNER_BAND_AM,
            MusiccastConstants::TUNER_BAND_FM,
            MusiccastConstants::TUNER_BAND_DAB
            ], $newBand
        );

        return $this->musiccastConnection->requestGet('tuner/getPresetInfo?band=' . $newBand, MusiccastTunerPresetInfoModel::class);
    }

    /**
     * Get tuner presets for the AM-band
     *
     * @return MusiccastTunerPresetInfoModel
     */
    public function getPresetsForAmBand(): MusiccastTunerPresetInfoModel
    {
        return $this->getPresets(MusiccastConstants::TUNER_BAND_AM);
    }

    /**
     * Get tuner presets for the FM-band
     *
     * @return MusiccastTunerPresetInfoModel
     */
    public function getPresetsForFmBand(): MusiccastTunerPresetInfoModel
    {
        return $this->getPresets(MusiccastConstants::TUNER_BAND_FM);
    }

    /**
     * Get tuner presets for the DAB-band
     *
     * @return MusiccastTunerPresetInfoModel
     */
    public function getPresetsForDabBand(): MusiccastTunerPresetInfoModel
    {
        return $this->getPresets(MusiccastConstants::TUNER_BAND_DAB);
    }

    /**
     * Retrieve playback information of Tuner
     *
     * @return MusiccastTunerPlayinfoModel
     */
    public function getPlayInfo(): MusiccastTunerPlayinfoModel
    {
        return $this->musiccastConnection->requestGet("tuner/getPlayInfo", MusiccastTunerPlayinfoModel::class);
    }

    /**
     * Set tuner band
     *
     * @param  string $newBand
     * Valid: "am", "fm", "dab"
     * @return MusiccastTunerSetBandModel
     */
    public function setBand(string $newBand): MusiccastTunerSetBandModel
    {
        MusiccastValidation::testInArray(
            [
            MusiccastConstants::TUNER_BAND_AM,
            MusiccastConstants::TUNER_BAND_FM,
            MusiccastConstants::TUNER_BAND_DAB
            ], $newBand
        );

        return $this->musiccastConnection->requestGet('tuner/setBand?band=' . $newBand, MusiccastTunerSetBandModel::class);
    }

    /**
     * Set Tuner frequenc (only valid for band am or fm)
     *
     * @param  string  $newBand
     * @param  integer $unit
     * @return MusiccastTunerSetFreqModel
     */
    public function setFrequency(string $newBand, int $unit): MusiccastTunerSetFreqModel
    {
        MusiccastValidation::testInArray(
            [
            MusiccastConstants::TUNER_BAND_AM,
            MusiccastConstants::TUNER_BAND_FM
            ], $newBand
        );

        return $this->musiccastConnection->requestGet(sprintf('tuner/setFreq?band=%s&tuning=direct&num=%d', $newBand, $unit), MusiccastTunerSetFreqModel::class);
    }

    /**
     * Recall a tuner preset
     *
     * @param  string  $newBand
     * @param  integer $newNumber
     * @return MusiccastTunerRecallPresetModel
     */
    public function recallPreset(string $newBand, int $newNumber): MusiccastTunerRecallPresetModel
    {
        $deviceFeature = $this->musiccastOperatorSystem->getDeviceFeatures();

        MusiccastValidation::testInArray(
            [
            MusiccastConstants::TUNER_BAND_AM,
            MusiccastConstants::TUNER_BAND_FM,
            MusiccastConstants::TUNER_BAND_DAB
            ], $newBand
        );

        MusiccastValidation::testIntValueBetween($newNumber, 1, $deviceFeature->tuner->preset->num);

        return $this->musiccastConnection->requestGet(sprintf('tuner/recallPreset?zone=%s&band=%s&num=%d', $this->musiccastConnection->getZone(), $newBand, $newNumber), MusiccastTunerRecallPresetModel::class);
    }
}
