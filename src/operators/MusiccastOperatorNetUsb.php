<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\operators;

use horstoeko\musiccast\MusiccastConnection;
use horstoeko\musiccast\utils\MusiccastValidation;
use horstoeko\musiccast\models\MusiccastNetUsbPresetInfoModel;
use horstoeko\musiccast\models\MusiccastRecallNetUsbPresetModel;

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
    public function getNetUsbPresets(): MusiccastNetUsbPresetInfoModel
    {
        $responseObject = $this->musiccastConnection->requestGet("netusb/getPresetInfo", MusiccastNetUsbPresetInfoModel::class);

        return $responseObject;
    }

    /**
     * Recall a tuner preset
     *
     * @param string $newBand
     * @param integer $newNumber
     * @return MusiccastRecallNetUsbPresetModel
     */
    public function recallNetUsbPreset(int $newNumber): MusiccastRecallNetUsbPresetModel
    {
        $deviceFeature = $this->musiccastOperatorSystem->getDeviceFeatures();

        MusiccastValidation::testIntValueBetween($newNumber, 1, $deviceFeature->netusb->preset->num);

        $responseObject = $this->musiccastConnection->requestGet("netusb/recallPreset?zone={$this->musiccastConnection->getZone()}&num={$newNumber}", MusiccastRecallNetUsbPresetModel::class);

        return $responseObject;
    }
}
