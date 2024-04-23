<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the device feature (for the system.tuner)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureNetUsbModel extends MusiccastBaseModel
{
    /**
     * Functions possible
     *
     * @var string[]
     */
    public $funcList = [];

    /**
     * Returns information related to Preset
     *
     * @var \horstoeko\musiccast\models\MusiccastPresetModel
     */
    public $preset = null;

    /**
     * Returns type of Net Radio. If there’s no list of this, it’s fixed to "vTuner"
     *
     * Values
     * - vtuner
     * - airabl
     *
     * @var string
     */
    public $netRadioType = "";

    /**
     * Returns information related to playback history
     *
     * @var \horstoeko\musiccast\models\MusiccastRecentInfoModel
     */
    public $recentInfo = null;

    /**
     * Reserved
     *
     * @var \horstoeko\musiccast\models\MusiccastPlayQueueModel
     */
    public $playQueue = null;

    /**
     * Reserved
     *
     * @var \horstoeko\musiccast\models\MusiccastPlaylistModel
     */
    public $mcPlaylist = null;

    /**
     * Tidal
     *
     * @var \horstoeko\musiccast\models\MusiccastTidalModel
     */
    public $tidal = null;
}