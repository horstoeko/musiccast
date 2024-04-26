<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the device feature input definiton
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureSystemInputModel extends MusiccastBaseModel
{
    /**
     * Input id
     *
     * @var string
     */
    public $id = "";

    /**
     * Returns whether an input can be a source of Link distribution
     *
     * @var boolean
     */
    public $distributionEnable = false;

    /**
     * Returns whether an input can be renamed
     *
     * @var boolean
     */
    public $renameEnable = false;

    /**
     * Return whether an input comes with an account info
     *
     * @var boolean
     */
    public $accountEnable = false;

    /**
     * Returns a type of playback info. Depending on this type, use specific API to retrieve appropriate playback info
     *
     * Values:
     * - none
     * - tuner
     * - netusb
     * - cd
     *
     * @var string
     */
    public $playInfoType = "";
}
