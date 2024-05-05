<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the response of the getSetting's qobutz quality values (Net/Usb)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbSettingsQobuzQualityValueModel extends MusiccastBaseModel
{
    /**
     * Returns value
     *
     * Values
     * - hr_192_24
     * - hr_96_24
     * - cd_44_16
     * - mp3_320
     *
     * @var string
     */
    public $value = "";

    /**
     * Attribute info. Attributes are expressed as OR of bit field as shown below;
     *
     * - b[0] Selectable
     *
     * @var integer
     */
    public $attribute = 0;
}
