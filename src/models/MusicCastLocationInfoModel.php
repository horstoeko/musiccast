<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the location information
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastLocationInfoModel extends MusiccastBaseModelWithReturnCode
{
    /**
     * Returns Location ID in 32-digit hex
     *
     * @var string
     */
    public $id = "";

    /**
     * Returns Location Name
     *
     * @var string
     */
    public $name = "";

    /**
     * Zone list
     *
     * @var \horstoeko\musiccast\models\MusiccastLocationInfoZonelistModel[]
     */
    public $zoneList = [];

    /**
     * Returns Stereo Pair setting status
     *
     * Values
     * - none
     * - master_left
     * - master_right
     * - slave_left
     * - slave_right"
     *
     * @var string
     */
    public $stereoPairStatus = "none";
}
