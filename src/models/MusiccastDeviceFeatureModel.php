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
     * system’s overall info
     *
     * @var \horstoeko\musiccast\models\MusiccastDeviceFeatureSystemModel
     */
    public $system = null;

    /**
     * Zone related information
     *
     * @var \horstoeko\musiccast\models\MusiccastDeviceFeatureZoneModel[]
     */
    public $zones = null;

    /**
     * Information related to Tuner function
     *
     * @var \horstoeko\musiccast\models\MusiccastDeviceFeatureTunerModel
     */
    public $tuner = null;

    /**
     * Information related to Net/USB function
     *
     * @var \horstoeko\musiccast\models\MusiccastDeviceFeatureNetUsbModel
     */
    public $netusb = null;

    /**
     * Get a zone definition by it's id
     *
     * @param  string $searchForId
     * @return MusiccastDeviceFeatureZoneModel|null
     */
    public function getZoneById(string $searchForId): ?MusiccastDeviceFeatureZoneModel
    {
        return array_reduce(
            $this->zones, static function ($carry, MusiccastDeviceFeatureZoneModel $zone) use ($searchForId) {
                return $carry ?? ($zone->id === $searchForId ? $zone : $carry);
            }, null
        );
    }
}
