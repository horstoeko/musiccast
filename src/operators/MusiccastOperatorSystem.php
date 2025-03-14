<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\operators;

use horstoeko\musiccast\utils\MusiccastValidation;
use horstoeko\musiccast\models\MusiccastDeviceInfoModel;
use horstoeko\musiccast\models\MusiccastLocationInfoModel;
use horstoeko\musiccast\models\MusiccastSystemRebootModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureModel;
use horstoeko\musiccast\models\MusiccastSystemNetworkRebootModel;

/**
 * Class representing the system operator
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastOperatorSystem extends MusiccastOperatorBase
{
    /**
     * Get the device info
     *
     * @return MusiccastDeviceInfoModel
     */
    public function getDeviceInfo(): MusiccastDeviceInfoModel
    {
        return $this->musiccastConnection->requestGet('system/getDeviceInfo', MusiccastDeviceInfoModel::class);
    }

    /**
     * Get the device features
     *
     * @return MusiccastDeviceFeatureModel
     */
    public function getDeviceFeatures(): MusiccastDeviceFeatureModel
    {
        return $this->musiccastConnection->requestGet('system/getFeatures', MusiccastDeviceFeatureModel::class);
    }

    /**
     * Get the device features
     *
     * @return MusiccastLocationInfoModel
     */
    public function getLocationInfo(): MusiccastLocationInfoModel
    {
        return $this->musiccastConnection->requestGet('system/getLocationInfo', MusiccastLocationInfoModel::class);
    }

    /**
     * Request Network module reboot. Available only when "network_reboot" exists in system - func_list under /system/getFeatures.
     *
     * @return MusiccastSystemNetworkRebootModel
     */
    public function rebootNetwork(): MusiccastSystemNetworkRebootModel
    {
        $allowedFunctions = $this->getDeviceFeatures()->system->funcList;

        MusiccastValidation::testInArray($allowedFunctions, "network_reboot");

        return $this->musiccastConnection->requestGet('system/requestNetworkReboot', MusiccastSystemNetworkRebootModel::class);
    }

    /**
     * equest System reboot. Available only when " system_reboot " exists in system - func_list under /system/getFeatures
     *
     * @return MusiccastSystemRebootModel
     */
    public function rebootSystem(): MusiccastSystemRebootModel
    {
        $allowedFunctions = $this->getDeviceFeatures()->system->funcList;

        MusiccastValidation::testInArray($allowedFunctions, "system_reboot");

        return $this->musiccastConnection->requestGet('system/requestNetworkReboot', MusiccastSystemRebootModel::class);
    }
}
