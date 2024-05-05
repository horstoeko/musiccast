<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the Net/Usb list info (getListInfo)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbListInfoModel extends MusiccastBaseModelWithReturnCode
{
    /**
     * Specifies target Input ID. (Available on and after API Version 1.17)
     *
     * @var string
     */
    public $input = "";

    /**
     * Menu layer
     *
     * Value Range: 0 - 15
     *
     * @var integer
     */
    public $menuLayer = 0;

    /**
     * max row number of the list
     *
     * Value Range: 0 - 65000
     *
     * @var integer
     */
    public $maxLine = 0;

    /**
     * The reference index of the lis
     *
     * @var integer
     */
    public $index = 0;

    /**
     * The index number in a list that is currently in playback. If no list element has playback
     * status, or playback status wasn’t found, returns -1
     *
     * @var integer
     */
    public $playingIndex = 0;

    /**
     * Menu name
     *
     * @var string
     */
    public $menuName = "";

    /**
     * Returns list info with the row number size specified by Request
     * Parameter. Returns empty data if index or size wasn’t specified. If the
     * max row number is reached in the middle of this list info, the list ends at
     * the max row.
     *
     * @var \horstoeko\musiccast\models\MusiccastNetUsbListInfoItemModel
     */
    public $listInfo = [];
}
