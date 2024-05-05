<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the Net/Usb playback info model
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbPlayinfoModel extends MusiccastBaseModelWithReturnCode
{
    /**
     * Current Net/USB related Input ID
     *
     * @var string
     */
    public $input = "";

    /**
     * Reserved
     *
     * @var string
     */
    public $playQueueType = "";

    /**
     * Playback status
     *
     * Values:
     * - play
     * - stop
     * - pause
     * - fast_reverse
     * - fast_forward
     *
     * @var string
     */
    public $playback = "";

    /**
     * Repeat setting status
     *
     * Value:
     * - off
     * - one
     * - all
     *
     * @var string
     */
    public $repeat = "";

    /**
     * shuffle setting status
     *
     * Values:
     * - off
     * - on
     * - songs
     * - albums
     *
     * @var string
     */
    public $shuffle = "";

    /**
     * Returns current settable repeat setting
     *
     * @var string[]
     */
    public $repeatAvailable = [];

    /**
     * current settable shuffle setting
     *
     * @var string[]
     */
    public $shuffleAvailable = [];

    /**
     * Returns current playback time (unit in second). Returns -60000 if playback time is invalid
     *
     * Value Range: -60000 (invalid) / -59999 ~ 59999 (valid)
     *
     * @var integer
     */
    public $playTime = 0;

    /**
     * Returns total playback time (unit in second). Returns 0 if total time is not available or invalid
     *
     * Value Range: 0 ~ 59999
     *
     * @var integer
     */
    public $totalTime = 0;

    /**
     * Artist name. Returns station name if the input is Net Radio / Pandora / radiko.
     * Station name/artist name if the input is Napster (Radio). If Net Radio is airable.radio, "(location / language)" will be
     * appended to the station name. Returns ad name if Pandora playbacks ad contents. If input is MC Link, returns master’s
     * internal content info or Room Name if the master input is one of external sources
     *
     * Text information may be left in artist / album / track while playback is stopped. At this time, you can expect playback
     * to start by sending a Play request, but another song different from the displayed song such as when playing the station
     * may be played. Please also note that there is no guarantee that playback will resume certainly depending on the situation
     *
     * @var string
     */
    public $artist = "";

    /**
     * Returns album name. Returns channel name if the input is SiriusXM. Returns subtitle name if the input is radiko.
     * Returns company name if Pandora playbacks an ad. If input is MC Link, returns master’s internal content info or Input
     * Name if the master input is one of external source
     *
     * @var string
     */
    public $album = "";

    /**
     * Returns track name. Returns song name if the input is Napster / SiriusXM / Pandora. Returns title name if the input is radiko.
     * If input is MC Link, returns master’s internal content info or empty text if the master input is one of external sources
     *
     * @var string
     */
    public $track = "";

    /**
     * Returns a URL to retrieve album art data. Data is in jpg/png/bmp/ymf format.The path is given as relative address.
     * If "xxx/yyy/zzz.jpg" is returned, the absolute path is expressed as http://{host}/xxx/yyy/zzz.jpg Note: ymf is original
     * format encrypted by Yamaha AV encryption method
     *
     * @var string
     */
    public $albumartUrl = "";

    /**
     * ID to identify album art. If ID got changed, retry to get album art data via albumart_url
     *
     * Value Range: 0 ～ 9999
     *
     * @var integer
     */
    public $albumartId = 0;

    /**
     * USB device type. Returns "unknown" if no USB is connected
     *
     * Values:
     * - msc
     * - ipod
     * - unknown
     *
     * @var string
     */
    public $usbDevicetype = "";

    /**
     * Returns whether or not auto top has initiated. If it is true, display appropriate messages to the external
     * application user interface depending on which input current one is. This flag is cleared (set back to false)
     * with these conditions as follows;
     * - Playback is initiated properly
     * - /netusb/setPlayback is executed
     * - type = play found in /netusb/setListControl is executed Target Input : Pandora / SiriusXM
     *
     * A MusicCast Device that detects non-operation time (by key operation on the Device or by remote control)
     * will always return false flag in this d
     *
     * @var boolean
     */
    public $autoStopped = false;

    /**
     * Returns playback attribute info. Attributes are expressed as OR of bit field as shown below
     * - b[0] Playable
     * - b[1] Capable of Stop
     * - b[2] Capable of Pause
     * - b[3] Capable of Prev Skip
     * - b[4] Capable of Next Skip
     * - b[5] Capable of Fast Reverse
     * - b[6] Capable of Fast Forward
     * - b[7] Capable of Repeat
     * - b[8] Capable of Shuffle
     * - b[9] Feedback Available (Pandora)
     * - b[10] Thumbs-Up (Pandora)
     * - b[11] Thumbs-Down (Pandora)
     * - b[12] Video (USB)
     * - b[13] Capable of Bookmark/Favorite (Net Radio / TIDAL / Deezer)
     * - b[14] DMR Playback (Server)
     * - b[15] Station Playback (Napster)
     * - b[16] AD Playback (Pandora)
     * - b[17] Shared Station (Pandora)
     * - b[18] Capable of Add Track (Napster/Pandora/JUKE/Qobuz)
     * - b[19] Capable of Add Album (Napster / JUKE)
     * - b[20] Shuffle Station (Pandora)
     * - b[21] Capable of Add Channel (Pandora)
     * - b[22] Sample Playback (JUKE)
     * - b[23] MusicPlay Playback (Server)
     * - b[24] Capable of Link Distribution
     * - b[25] Capable of Add Playlist (Qobuz)
     * - b[26] Capable of add MusicCast Playlist
     * - b[27] Capable of Add to Playlist (TIDAL / Deezer)
     *
     * With Pandora, b[9] = 1 validates "thumbs_up" / "thumbs_down" / "mark_tired" of managePlay and "why_this_song"
     * of getPlayDescription. b[21] = 1 validates "add_channel_track" / "add_channel_artist"
     *
     * @var integer
     */
    public $attribute = 0;
}
