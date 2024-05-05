<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the Net/Usb list info item (getListInfo)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbListInfoItemModel extends MusiccastBaseModel
{
    /**
     * Text info to display
     *
     * @var string
     */
    public $text = "";

    /**
     * Sub text info. Returns in order of priority to display.
     *
     * @var string[]
     */
    public $subtexts = [];

    /**
     * Return a URL to retrieve thumbnail data. Returns "" (empty text) if no thumbnail is available
     *
     * @var string
     */
    public $thumbnail = "";

    /**
     * Return a URL to retrieve logo data. Returns "" (empty text) if no logo is available
     *
     * @var string
     */
    public $logo = "";

    /**
     * Attribute info of list elements. Attributes are expressed as OR of bit field as shown below:
     *
     * - b[0] Name exceeds max byte limit (common for all Net/USB sources)
     * - b[1] Capable of Select (common for all Net/USB sources)
     * - b[2] Capable of Play (common for all Net/USB sources)
     * - b[3] Capable of Search (Napster/ JUKE)
     * - b[4] Album Art available (common for all Net/USB sources)
     * - b[5] Now Playing (Pandora)
     * - b[6] Capable of Add Bookmark/Favorite (Net Radio/ TIDAL/ Deezer)
     * - b[7] Capable of Add Track (Napster/JUKE/Qobuz)
     * - b[8] Capable of Add Album (Napster/JUKE/Qobuz)
     * - b[9] Capable of Add Channel (Napster/Pandora)
     * - b[10] Capable of Remove Bookmark/Favorite (Net Radio/TIDAL/Deezer)
     * - b[11] Capable of Remove Track (Napster/JUKE/Qobuz)
     * - b[12] Capable of Remove Album (Napster/JUKE/Qobuz)
     * - b[13] Capable of Remove Channel (Napster/Pandora)
     * - b[14] Capable of Remove Playlist (Napster/Qobuz)
     * - b[15] Playlist (JUKE/Qobuz)
     * - b[16] Radio (JUKE)
     * - b[17] Shuffle (Pandora)
     * - b[18] Shared Station (Pandora)
     * - b[19] Premium Item (radiko)
     * - b[20] Capable of Add Artist (Qobuz)
     * - b[21] Capable of Remove Artist (Qobuz)
     * - b[22] Capable of Add Playlist (Qobuz)
     * - b[23] Capable of Play Now
     * - b[24] Capable of Play Next
     * - b[25] Capable of Add Play Queue
     * - b[26] Capable of Add MusicCast Playlist
     * - b[27] Capable of Add to Playlist (TIDAL/Deezer)
     * - b[28] Capable of Remove from Playlist (TIDAL/Deezer)
     *
     * Regarding an element with its attributes of b[1] and b[2] both set as 1, it is
     * valid to do both layer movement/shift and start playback by setListControl.
     * If an element got neither b[1] = 0 nor b[2] = 0, it is unavailable content
     * so apply appropriate UI reaction like making it gray-out etc
     *
     * @var integer
     */
    public $attribute = 0;
}
