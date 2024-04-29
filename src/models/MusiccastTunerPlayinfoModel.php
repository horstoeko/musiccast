<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the tuner playback info model
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastTunerPlayinfoModel extends MusiccastBaseModelWithReturnCode
{
    /**
     * Current Band
     *
     * Values
     * - am
     * - fm
     * - dab
     *
     * @var string
     */
    public $band = "";

    /**
     * Auto Scan (Up or Down) status
     *
     * @var boolean
     */
    public $autoScan = false;

    /**
     * Returns Auto Preset execution status
     *
     * @var boolean
     */
    public $autoPreset = false;
}