<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\operators;

use horstoeko\musiccast\models\MusiccastLocationInfoModel;
use horstoeko\musiccast\models\MusiccastDeviceInfoModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureModel;

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
        $responseObject = $this->musiccastConnection->requestGet('system/getDeviceInfo', MusiccastDeviceInfoModel::class);

        return $responseObject;
    }

    /**
     * Get the device features
     *
     * @return MusiccastDeviceFeatureModel
     */
    public function getDeviceFeatures(): MusiccastDeviceFeatureModel
    {
        $responseObject = $this->musiccastConnection->requestGet('system/getFeatures', MusiccastDeviceFeatureModel::class);

        return $responseObject;
    }

    /**
     * Get the device features
     *
     * @return MusiccastLocationInfoModel
     */
    public function getLocationInfo(): MusiccastLocationInfoModel
    {
        $responseObject = $this->musiccastConnection->requestGet('system/getLocationInfo', MusiccastLocationInfoModel::class);

        return $responseObject;
    }
}
