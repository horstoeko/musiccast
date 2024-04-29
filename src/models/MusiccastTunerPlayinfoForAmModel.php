<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the tuner am-band playback info model (AM related informatio)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastTunerPlayinfoForAmModel extends MusiccastBaseModel
{
    /**
     * Returns current preset number. 0 when there’s no presets
     * Values: 0 (no presets), or one in the range gotten via /system/getFeatures
     *
     * @var integer
     */
    public $preset = 0;

    /**
     * Frequency (unit in kHz)
     *
     * @var integer
     */
    public $freq = 0;

    /**
     * Tuned status
     *
     * @var boolean
     */
    public $tuned = false;
}