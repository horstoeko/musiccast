<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the response of the getSettings (Net/Usb)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbSettingsModel extends MusiccastBaseModelWithReturnCode
{
    /**
     * Information related to Qobuz.
     * Retrievable only when products are equipped with Qobuz functions
     *
     * @var \horstoeko\musiccast\models\MusiccastNetUsbSettingsQobuzModel
     */
    public $qobuz = null;
}
