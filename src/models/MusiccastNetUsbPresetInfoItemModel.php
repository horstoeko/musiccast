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
class MusiccastNetUsbPresetInfoItemModel extends MusiccastBaseModel
{
    /**
     * Returns Input ID. Returns "unknown" if no presets available
     *
     * @var string
     */
    public $input = "";

    /**
     * Returns text info. Returns "" (empty text) if no presets available
     *
     * @var string
     */
    public $text = "";

    /**
     * Reserved
     *
     * @var integer
     */
    public $attribute = 0;
}
