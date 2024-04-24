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
use horstoeko\musiccast\models\MusiccastSetTunerBandModel;
use horstoeko\musiccast\models\MusiccastTunerPresetInfoModel;
use horstoeko\musiccast\models\MusiccastRecallTunerPresetModel;

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
     * @param string $newBand
     * @return MusiccastTunerPresetInfoModel
     */
    public function getTunerPresets(string $newBand): MusiccastTunerPresetInfoModel
    {
        MusiccastValidation::testInArray([
            MusiccastConstants::TUNER_BAND_AM,
            MusiccastConstants::TUNER_BAND_FM,
            MusiccastConstants::TUNER_BAND_DAB
        ], $newBand);

        $responseObject = $this->musiccastConnection->requestGet("tuner/getPresetInfo?band={$newBand}", MusiccastTunerPresetInfoModel::class);

        return $responseObject;
    }

    /**
     * Get tuner presets for the AM-band
     *
     * @return MusiccastTunerPresetInfoModel
     */
    public function getTunerPresetsForAmBand(): MusiccastTunerPresetInfoModel
    {
        return $this->getTunerPresets(MusiccastConstants::TUNER_BAND_AM);
    }

    /**
     * Get tuner presets for the FM-band
     *
     * @return MusiccastTunerPresetInfoModel
     */
    public function getTunerPresetsForFmBand(): MusiccastTunerPresetInfoModel
    {
        return $this->getTunerPresets(MusiccastConstants::TUNER_BAND_FM);
    }

    /**
     * Get tuner presets for the DAB-band
     *
     * @return MusiccastTunerPresetInfoModel
     */
    public function getTunerPresetsForDabBand(): MusiccastTunerPresetInfoModel
    {
        return $this->getTunerPresets(MusiccastConstants::TUNER_BAND_DAB);
    }

    /**
     * Set tuner band
     *
     * @param string $newBand
     * Valid: "am", "fm", "dab"
     * @return MusiccastSetTunerBandModel
     */
    public function setTunerBand(string $newBand): MusiccastSetTunerBandModel
    {
        MusiccastValidation::testInArray([
            MusiccastConstants::TUNER_BAND_AM,
            MusiccastConstants::TUNER_BAND_FM,
            MusiccastConstants::TUNER_BAND_DAB
        ], $newBand);

        $responseObject = $this->musiccastConnection->requestGet("tuner/setBand?band={$newBand}", MusiccastSetTunerBandModel::class);

        return $responseObject;
    }

    /**
     * Recall a tuner preset
     *
     * @param string $newBand
     * @param integer $newNumber
     * @return MusiccastRecallTunerPresetModel
     */
    public function recallTunerPreset(string $newBand, int $newNumber): MusiccastRecallTunerPresetModel
    {
        $deviceFeature = $this->musiccastOperatorSystem->getDeviceFeatures();

        MusiccastValidation::testInArray([
            MusiccastConstants::TUNER_BAND_AM,
            MusiccastConstants::TUNER_BAND_FM,
            MusiccastConstants::TUNER_BAND_DAB
        ], $newBand);

        MusiccastValidation::testIntValueBetween($newNumber, 1, $deviceFeature->tuner->preset->num);

        $responseObject = $this->musiccastConnection->requestGet("tuner/recallPreset?zone={$this->musiccastConnection->getZone()}&band={$newBand}&num={$newNumber}", MusiccastRecallTunerPresetModel::class);

        return $responseObject;
    }
}