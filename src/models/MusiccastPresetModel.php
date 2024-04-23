<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the device feature (for the system.zone)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastPresetModel extends MusiccastBaseModel
{
    /**
     * Type
     *
     * @var string
     */
    public $type = "";

    /**
     * Number of presets available
     *
     * @var integer
     */
    public $num = 0;
}
