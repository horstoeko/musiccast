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

    public const VOLUME_UP = "up";
    public const VOLUME_DOWN = "down";

    public const TUNER_BAND_AM = "am";
    public const TUNER_BAND_FM = "fm";
    public const TUNER_BAND_DAB = "dab";

    public const NETUSB_PLAY = "play";
    public const NETUSB_STOP = "stop";
    public const NETUSB_PAUSE = "pause";
    public const NETUSB_PLAY_PAUSE = "play_pause";
    public const NETUSB_PREVIOUS = "previous";
    public const NETUSB_NEXT = "next";
    public const NETUSB_FAST_REVERSE_START = "fast_reverse_start";
    public const NETUSB_FAST_REVERSE_END = "fast_reverse_end";
    public const NETUSB_FAST_FORWARD_START = "fast_forward_start";
    public const NETUSB_FAST_FORWARD_END = "fast_forward_end";

    public const NETUSB_REPEAT_OFF = "off";
    public const NETUSB_REPEAT_ONE = "one";
    public const NETUSB_REPEAT_ALL = "all";

    public const NETUSB_SHUFFLE_OFF = "off";
    public const NETUSB_SHUFFLE_ON = "on";
    public const NETUSB_SHUFFLE_SONGS = "songs";
    public const NETUSB_SHUFFLE_ALBUMS = "albums";

    public const NETUSB_SETLISTCTRL_SELECT = "select";
    public const NETUSB_SETLISTCTRL_PLAY = "play";
    public const NETUSB_SETLISTCTRL_RETURN = "return";
}
