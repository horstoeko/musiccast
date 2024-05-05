<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the Net/Usb recent info (getRecentInfo)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbRecentInfoModel extends MusiccastBaseModelWithReturnCode
{
    /**
     * playback history. Element number of an array can be gotten via system/getFeatures
     *
     * @var \horstoeko\musiccast\models\MusiccastNetUsbRecentInfoItemModel[]
     */
    public $recentInfo = null;
}
