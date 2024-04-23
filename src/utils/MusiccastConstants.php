<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\utils;

/**
 * Class representing validations constants
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastConstants
{
    public const POWER_ON = "on";
    public const POWER_OFF = "standby";
    public const POWER_TOGGLE = "toggle";

    public const TUNER_BAND_AM = "am";
    public const TUNER_BAND_FM = "fm";
    public const TUNER_BAND_DAB = "dab";
}