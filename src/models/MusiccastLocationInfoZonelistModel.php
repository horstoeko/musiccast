<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the zone list (for location info)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastLocationInfoZonelistModel extends MusiccastBaseModel
{
    /**
     * Returns whether or not Main Zone Location setup is valid
     *
     * @var boolean
     */
    public $main = false;

    /**
     * Returns whether or not Zone2 Location setup is valid
     *
     * @var boolean
     */
    public $zone2 = false;

    /**
     * Returns whether or not Zone3 Location setup is valid
     *
     * @var boolean
     */
    public $zone3 = false;

    /**
     * Returns whether or not Zone4 Location setup is valid
     *
     * @var boolean
     */
    public $zone4 = false;
}