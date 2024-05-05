<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the device feature (for system)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureSystemModel extends MusiccastBaseModel
{
    /**
     * List of valid function
     *
     * @var string[]
     */
    public $funcList = [];

    /**
     * Zone numbers. Zone B is treated as Zone2 in YXC so a Device with ZoneB returns 2.
     * A Device without Zones returns 1
     *
     * @var integer
     */
    public $zoneNum = 0;

    /**
     * List of inputs
     *
     * @var \horstoeko\musiccast\models\MusiccastDeviceFeatureSystemInputModel[]
     */
    public $inputList = [];

    /**
     * Minimum/Maximum/Step values of a parameter
     *
     * @var \horstoeko\musiccast\models\MusiccastDeviceFeatureRangeModel[]
     */
    public $rangeStep = [];

    /**
     * Web Control URL
     *
     * @var string
     */
    public $webControlUrl = "";

    /**
     * Get a list of all input id's
     *
     * @return array
     */
    public function getInputIds(): array
    {
        return array_map(
            function (MusiccastDeviceFeatureSystemInputModel $item) {
                return $item->id;
            },
            $this->inputList
        );
    }

    /**
     * Get a list of valid input sources for Tuner
     *
     * @return array
     */
    public function getInputIdsForTuner(): array
    {
        return array_map(function (MusiccastDeviceFeatureSystemInputModel $item) {
            return $item->id;
        }, array_filter($this->inputList, function (MusiccastDeviceFeatureSystemInputModel $item) {
            return strcasecmp($item->playInfoType, "tuner") === 0;
        }));
    }

    /**
     * Get a list of valid input sources for Net/Usb
     *
     * @return array
     */
    public function getInputIdsForNetUsb(): array
    {
        return array_map(function (MusiccastDeviceFeatureSystemInputModel $item) {
            return $item->id;
        }, array_filter($this->inputList, function (MusiccastDeviceFeatureSystemInputModel $item) {
            return strcasecmp($item->playInfoType, "netusb") === 0;
        }));
    }
}
