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
class MusiccastTunerNetUsbInfoItemModel extends MusiccastBaseModel
{
    /**
     * Band (am, fm, dab)
     *
     * @var string
     */
    public $band = "";

    /**
     * Returns
     * - frequency (unit in kHz) (band = AM or FM)
     * - Station ID (band = DAB)
     * 0 when there’s no presets
     *
     * @var integer
     */
    public $number = 0;

    /**
     * Reserved
     *
     * @var int
     */
    public $hdprogram = 0;

    /**
     * Reterns text information of FM(RDS) or DAB
     *
     * @var string
     */
    public $text = "";
}
