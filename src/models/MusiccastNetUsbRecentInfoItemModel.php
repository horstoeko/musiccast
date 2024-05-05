<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the Net/Usb item of the recent info (getRecentInfo)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbRecentInfoItemModel extends MusiccastBaseModel
{
    /**
     * Input ID
     *
     * @var string
     */
    public $input = "";

    /**
     * Text information
     *
     * @var string
     */
    public $text = "";

    /**
     * URL to retrieve album art data. Returns "" (empty text) if no URL is available
     *
     * @var string
     */
    public $albumartUrl = "";

    /**
     * Number of playback count. Playback count is cleard when it’s cleared in playback history.
     *
     * @var integer
     */
    public $playCount = 0;

    /**
     * Reserved
     *
     * @var integer
     */
    public $attribute = 0;
}
