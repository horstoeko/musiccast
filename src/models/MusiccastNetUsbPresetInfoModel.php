<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the tuner preset info model
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbPresetInfoModel extends MusiccastBaseModelWithReturnCode
{
    /**
     * Preset Info. Element number of an array can be gotten via system/getFeatures
     *
     * @var \horstoeko\musiccast\models\MusiccastNetUsbPresetInfoItemModel[]
     */
    public $presetInfo = [];

    /**
     * list of valid functions for Preset. (Recall/Store functions are always valid without specifically listed here)
     *
     * Values:
     * - clear
     * - move
     *
     * @var string[]
     */
    public $funcList = [];

    /**
     * Find the first matching preset index by the preset text
     * If nothing is found false is returned
     *
     * @param  string $newText
     * @return integer|boolean
     */
    public function getIndexByText(string $newText)
    {
        $arr = array_filter(
            $this->presetInfo, function (MusiccastNetUsbPresetInfoItemModel $item) use ($newText) {
                return strcasecmp(trim($item->text), trim($newText)) === 0;
            }
        );

        if (reset($arr) === false) {
            return false;
        }

        return key($arr);
    }
}
