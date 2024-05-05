<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the tuner am-band playback info model
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastTunerPlayinfoForRdsModel extends MusiccastBaseModel
{
    /**
     * Programm type
     *
     * @var string
     */
    public $programType = "";

    /**
     * Programm service
     *
     * @var string
     */
    public $programService = "";

    /**
     * Radio Text A
     *
     * @var string
     */
    public $radioTextA = "";

    /**
     * Radio Text B
     *
     * @var string
     */
    public $radioTextB = "";
}
