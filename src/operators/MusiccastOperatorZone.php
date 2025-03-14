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
use horstoeko\musiccast\models\MusiccastZonePowerModel;
use horstoeko\musiccast\models\MusiccastZoneVolumeModel;
use horstoeko\musiccast\models\MusiccastZoneSetInputModel;
use horstoeko\musiccast\models\MusiccastZoneMuteModel;
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
     * Returns zone status
     *
     * @return MusiccastZoneStatusModel
     */
    public function getStatus(): MusiccastZoneStatusModel
    {
        return $this->musiccastConnection->requestGet($this->musiccastConnection->getZone() . '/getStatus', MusiccastZoneStatusModel::class);
    }

    /**
     * Helper method for Power-on-Off-Toggle
     *
     * @param  string $operation
     * @return MusiccastZonePowerModel
     */
    private function internalPowerOperation(string $operation): MusiccastZonePowerModel
    {
        MusiccastValidation::testInArray([MusiccastConstants::POWER_ON, MusiccastConstants::POWER_OFF, MusiccastConstants::POWER_TOGGLE], $operation);

        return $this->musiccastConnection->requestGet(sprintf('%s/setPower?power=%s', $this->musiccastConnection->getZone(), $operation), MusiccastZonePowerModel::class);
    }

    /**
     * Power-On device
     *
     * @return MusiccastZonePowerModel
     */
    public function powerOn(): MusiccastZonePowerModel
    {
        return $this->internalPowerOperation(MusiccastConstants::POWER_ON);
    }

    /**
     * Power-Off device
     *
     * @return MusiccastZonePowerModel
     */
    public function powerOff(): MusiccastZonePowerModel
    {
        return $this->internalPowerOperation(MusiccastConstants::POWER_OFF);
    }

    /**
     * Toggle Power-On/Off-State
     *
     * @return MusiccastZonePowerModel
     */
    public function powerToggle(): MusiccastZonePowerModel
    {
        return $this->internalPowerOperation(MusiccastConstants::POWER_TOGGLE);
    }

    /**
     * Internal helper for setting the volume
     *
     * @param  string|integer $newVolume
     * @param  integer        $newStep
     * @return MusiccastZoneVolumeModel
     */
    private function internalVolumeOperation($newVolume, int $newStep = 1): MusiccastZoneVolumeModel
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
        } elseif (is_string($newVolume)) {
            MusiccastValidation::testInArray([MusiccastConstants::VOLUME_DOWN, MusiccastConstants::VOLUME_UP], $newVolume);
        } else {
            throw new InvalidArgumentException("The new volume must be an integer or 'up'/'down'");
        }

        return $this->musiccastConnection->requestGet(sprintf('%s/setVolume?volume=%s&step=%d', $this->musiccastConnection->getZone(), $newVolume, $newStep), MusiccastZoneVolumeModel::class);
    }

    /**
     * Change the volume in the current zone
     *
     * @param  integer $newVolume
     * @param  integer $newStep
     * @return MusiccastZoneVolumeModel
     */
    public function setVolume(int $newVolume, int $newStep = 1): MusiccastZoneVolumeModel
    {
        return $this->internalVolumeOperation($newVolume, $newStep);
    }

    /**
     * Change the volume upwards
     *
     * @param  integer $newStep
     * @return MusiccastZoneVolumeModel
     */
    public function setVolumeUp(int $newStep = 1): MusiccastZoneVolumeModel
    {
        return $this->internalVolumeOperation(MusiccastConstants::VOLUME_UP, $newStep);
    }

    /**
     * Change the volume downwards
     *
     * @param  integer $newStep
     * @return MusiccastZoneVolumeModel
     */
    public function setVolumeDown(int $newStep = 1): MusiccastZoneVolumeModel
    {
        return $this->internalVolumeOperation(MusiccastConstants::VOLUME_DOWN, $newStep);
    }

    /**
     * Helper-method for mute-/unmute operations
     *
     * @param  boolean $newMute
     * @return MusiccastZoneMuteModel
     */
    private function internalMuteOperation(bool $newMute): MusiccastZoneMuteModel
    {
        $zoneStatus = $this->getStatus();

        MusiccastValidation::testStringValueEquals($zoneStatus->power, MusiccastConstants::POWER_ON);

        $parameter = ($newMute ? "true" : "false");

        return $this->musiccastConnection->requestGet(sprintf('%s/setMute?enable=%s', $this->musiccastConnection->getZone(), $parameter), MusiccastZoneMuteModel::class);
    }

    /**
     * Mute current zone
     *
     * @return MusiccastZoneMuteModel
     */
    public function setMute(): MusiccastZoneMuteModel
    {
        return $this->internalMuteOperation(true);
    }

    /**
     * Unkute current zone
     *
     * @return MusiccastZoneMuteModel
     */
    public function setUnmute(): MusiccastZoneMuteModel
    {
        return $this->internalMuteOperation(false);
    }

    /**
     * Switch/Set the device input
     *
     * @param  string $newInputName
     * @return MusiccastZoneSetInputModel
     */
    public function setInput(string $newInputName): MusiccastZoneSetInputModel
    {
        $zoneStatus = $this->getStatus();

        MusiccastValidation::testStringValueEquals($zoneStatus->power, MusiccastConstants::POWER_ON);

        $deviceFeatures = $this->musiccastOperatorSystem->getDeviceFeatures();

        MusiccastValidation::testInArray($deviceFeatures->system->getInputIds(), $newInputName);

        return $this->musiccastConnection->requestGet(sprintf('%s/setInput?input=%s', $this->musiccastConnection->getZone(), $newInputName), MusiccastZoneSetInputModel::class);
    }
}
