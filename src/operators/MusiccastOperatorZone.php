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
use horstoeko\musiccast\models\MusiccastPowerModel;
use horstoeko\musiccast\models\MusiccastVolumeModel;
use horstoeko\musiccast\models\MusiccastSetInputModel;
use horstoeko\musiccast\models\MusiccastVolumeMuteModel;
use horstoeko\musiccast\models\MusiccastZoneStatusModel;
use horstoeko\musiccast\utils\MusiccastConstants;
use InvalidArgumentException;

/**
 * Class representing the zone operator
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastOperatorZone extends MusiccastOperatorBase
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
     * Returns zone status
     *
     * @return MusiccastZoneStatusModel
     */
    public function getStatus(): MusiccastZoneStatusModel
    {
        $responseObject = $this->musiccastConnection->requestGet("{$this->musiccastConnection->getZone()}/getStatus", MusiccastZoneStatusModel::class);

        return $responseObject;
    }

    /**
     * Helper method for Power-on-Off-Toggle
     *
     * @param string $operation
     * @return MusiccastPowerModel
     */
    private function internalPowerOperation(string $operation): MusiccastPowerModel
    {
        MusiccastValidation::testInArray([MusiccastConstants::POWER_ON, MusiccastConstants::POWER_OFF, MusiccastConstants::POWER_TOGGLE], $operation);

        $responseObject = $this->musiccastConnection->requestGet("{$this->musiccastConnection->getZone()}/setPower?power={$operation}", MusiccastPowerModel::class);

        return $responseObject;
    }

    /**
     * Power-On device
     *
     * @return MusiccastPowerModel
     */
    public function powerOn(): MusiccastPowerModel
    {
        return $this->internalPowerOperation(MusiccastConstants::POWER_ON);
    }

    /**
     * Power-Off device
     *
     * @return MusiccastPowerModel
     */
    public function powerOff(): MusiccastPowerModel
    {
        return $this->internalPowerOperation(MusiccastConstants::POWER_OFF);
    }

    /**
     * Toggle Power-On/Off-State
     *
     * @return MusiccastPowerModel
     */
    public function powerToggle(): MusiccastPowerModel
    {
        return $this->internalPowerOperation(MusiccastConstants::POWER_TOGGLE);
    }

    /**
     * Internal helper for setting the volume
     *
     * @param string|integer $newVolume
     * @param integer $newStep
     * @return MusiccastVolumeModel
     */
    private function internalVolumeOperation($newVolume, int $newStep = 1): MusiccastVolumeModel
    {
        $zoneStatus = $this->getStatus();

        MusiccastValidation::testStringValueEquals($zoneStatus->power, MusiccastConstants::POWER_ON);

        if (is_int($newVolume)) {
            $deviceFeatures = $this->musiccastOperatorSystem->getDeviceFeatures();

            MusiccastValidation::testIntValueBetween(
                $newVolume,
                $deviceFeatures->getZoneById($this->musiccastConnection->getZone())->getRangeStepById("volume")->min,
                $deviceFeatures->getZoneById($this->musiccastConnection->getZone())->getRangeStepById("volume")->max
            );
        }
        elseif (is_string($newVolume)) {
            MusiccastValidation::testInArray([MusiccastConstants::VOLUME_DOWN, MusiccastConstants::VOLUME_UP], $newVolume);
        }
        else {
            throw new InvalidArgumentException("The new volume must be an integer or 'up'/'down'");
        }

        $responseObject = $this->musiccastConnection->requestGet("{$this->musiccastConnection->getZone()}/setVolume?volume={$newVolume}&step={$newStep}", MusiccastVolumeModel::class);

        return $responseObject;
    }

    /**
     * Change the volume in the current zone
     *
     * @param integer $newVolume
     * @param integer $newStep
     * @return MusiccastVolumeModel
     */
    public function setVolume(int $newVolume, int $newStep = 1): MusiccastVolumeModel
    {
        return $this->internalVolumeOperation($newVolume, $newStep);
    }

    /**
     * Change the volume upwards
     *
     * @param integer $newStep
     * @return MusiccastVolumeModel
     */
    public function setVolumeUp(int $newStep = 1): MusiccastVolumeModel
    {
        return $this->internalVolumeOperation(MusiccastConstants::VOLUME_UP, $newStep);
    }

    /**
     * Change the volume downwards
     *
     * @param integer $newStep
     * @return MusiccastVolumeModel
     */
    public function setVolumeDown(int $newStep = 1): MusiccastVolumeModel
    {
        return $this->internalVolumeOperation(MusiccastConstants::VOLUME_DOWN, $newStep);
    }

    /**
     * Helper-method for mute-/unmute operations
     *
     * @param boolean $newMute
     * @return MusiccastVolumeMuteModel
     */
    private function internalMuteOperation(bool $newMute): MusiccastVolumeMuteModel
    {
        $zoneStatus = $this->getStatus();

        MusiccastValidation::testStringValueEquals($zoneStatus->power, MusiccastConstants::POWER_ON);

        $parameter = ($newMute === true ? "true" : "false");

        $responseObject = $this->musiccastConnection->requestGet("{$this->musiccastConnection->getZone()}/setMute?enable={$parameter}", MusiccastVolumeMuteModel::class);

        return $responseObject;
    }

    /**
     * Mute current zone
     *
     * @return MusiccastVolumeMuteModel
     */
    public function setMute(): MusiccastVolumeMuteModel
    {
        return $this->internalMuteOperation(true);
    }

    /**
     * Unkute current zone
     *
     * @return MusiccastVolumeMuteModel
     */
    public function setUnmute(): MusiccastVolumeMuteModel
    {
        return $this->internalMuteOperation(false);
    }

    /**
     * Switch/Set the device input
     *
     * @param string $newInputName
     * @return MusiccastSetInputModel
     */
    public function setInput(string $newInputName): MusiccastSetInputModel
    {
        $zoneStatus = $this->getStatus();

        MusiccastValidation::testStringValueEquals($zoneStatus->power, MusiccastConstants::POWER_ON);

        $deviceFeatures = $this->musiccastOperatorSystem->getDeviceFeatures();

        MusiccastValidation::testInArray($deviceFeatures->system->getInputIds(), $newInputName);

        $responseObject = $this->musiccastConnection->requestGet("{$this->musiccastConnection->getZone()}/setInput?input={$newInputName}", MusiccastSetInputModel::class);

        return $responseObject;
    }
}
