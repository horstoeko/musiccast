<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the zone status model
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastZoneStatusModel extends MusiccastBaseModelWithReturnCode
{
    /**
     * Returns power status
     *
     * Values
     * - on
     * - standby
     *
     * @var string
     */
    public $power = "";

    /**
     * Returns Sleep Timer setup value (unit in minutes)
     *
     * Values
     * - 0
     * - 30
     * - 60
     * - 90
     * - 120
     *
     * @var integer
     */
    public $sleep = 0;

    /**
     * Returns volume value
     *
     * @var integer
     */
    public $volume = 0;

    /**
     * Returns mute status
     *
     * @var boolean
     */
    public $mute = false;

    /**
     * Returns Max Volume setup
     *
     * @var integer
     */
    public $maxVolume = 0;

    /**
     * Returns selected Input ID
     *
     * @var string
     */
    public $input = "";

    /**
     * Returns text information selected Input ID
     *
     * @var string
     */
    public $inputText = "";

    /**
     * Returns whether or not current Input is distributable status
     *
     * @var boolean
     */
    public $distributionEnable = false;

    /**
     * Returns selected Sound Program ID
     *
     * @var string
     */
    public $soundProgram = "";

    /**
     * Returns selected Surround Decoder Type
     *
     * @var string
     */
    public $surrDecoderType = "";

    /**
     * Returns 3D Surround status
     *
     * @var boolean
     */
    public $surround3d = false;

    /**
     * Returns Direct status
     *
     * @var boolean
     */
    public $direct = false;

    /**
     * Returns Pure Direct status
     *
     * @var boolean
     */
    public $pureDirect = false;

    /**
     * Returns Enhancer status
     *
     * @var boolean
     */
    public $enhancer = false;
}