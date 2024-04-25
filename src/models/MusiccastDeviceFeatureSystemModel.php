<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the device feature (for the system)
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
     * Functions possible
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
     * Input list
     *
     * @var MusiccastDeviceFeatureInputModel[]
     */
    public $inputList;

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
        return array_map(function (MusiccastDeviceFeatureInputModel $item) {
            return $item->id;
        }, $this->inputList);
    }
}
