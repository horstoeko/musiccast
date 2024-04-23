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
     * Presets
     *
     * @var \horstoeko\musiccast\models\MusiccastNetUsbPresetInfoItemModel[]
     */
    public $presetInfo = [];

    /**
     * Available functions
     *
     * @var array
     */
    public $funcList = [];

    /**
     * Find the first matching preset index by the preset text
     * If nothing is found false is returned
     *
     * @param string $newText
     * @return integer|boolean
     */
    public function getIndexByText(string $newText)
    {
        $arr = array_filter($this->presetInfo, function (MusiccastNetUsbPresetInfoItemModel $item) use ($newText) {
            return strcasecmp(trim($item->text), trim($newText)) === 0;
        });

        if (reset($arr) === false) {
            return false;
        }

        return key($arr);
    }
}