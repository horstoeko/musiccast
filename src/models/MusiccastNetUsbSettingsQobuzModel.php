<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the response of the getSetting's qobutz (Net/Usb)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbSettingsQobuzModel extends MusiccastBaseModel
{
    /**
     * Undocumented variable
     *
     * @var \horstoeko\musiccast\models\MusiccastNetUsbSettingsQobuzQualityModel
     */
    public $quality = null;
}
