<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the device feature (information related to Preset for Net/Usb)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeaturePresetModel extends MusiccastBaseModel
{
    /**
     * Type
     *
     * @var string
     */
    public $type = "";

    /**
     * Returns preset capable number. All sources of Net/USB Input share this presets
     *
     * @var integer
     */
    public $num = 0;
}
