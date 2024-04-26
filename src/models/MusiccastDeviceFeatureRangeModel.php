<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the minimum/maximum/step values of a parameter
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureRangeModel extends MusiccastBaseModel
{
    /**
     * ID
     *
     * @var string
     */
    public $id = "";

    /**
     * Minimum value
     *
     * @var integer
     */
    public $min = 0;

    /**
     * Maximum value
     *
     * @var integer
     */
    public $max = 0;

    /**
     * Steps
     *
     * @var integer
     */
    public $step = 0;
}
