<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the device feature
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureModel extends MusiccastBaseModelWithReturnCode
{
    /**
     * System Features
     *
     * @var MusiccastDeviceFeatureSystemModel
     */
    public $system = null;

    /**
     * Zones
     *
     * @var MusiccastDeviceFeatureZoneModel[]
     */
    public $zones = null;

    /**
     * Tuner
     *
     * @var MusiccastDeviceFeatureTunerModel
     */
    public $tuner = null;

    /**
     * Net/USB
     *
     * @var MusiccastDeviceFeatureNetUsbModel
     */
    public $netusb = null;

    /**
     * Get a zone definition by it's id
     *
     * @param string $id
     * @return MusiccastDeviceFeatureZoneModel|null
     */
    public function getZoneById(string $searchForId): ?MusiccastDeviceFeatureZoneModel
    {
        return array_reduce($this->zones, static function ($carry, MusiccastDeviceFeatureZoneModel $zone) use ($searchForId) {
            return $carry ?? ($zone->id === $searchForId ? $zone : $carry);
        }, null);
    }
}