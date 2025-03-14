<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the device feature (for the tuner)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureTunerModel extends MusiccastBaseModel
{
    /**
     * Functions possible
     *
     * @var string[]
     */
    public $funcList = [];

    /**
     * Returns object ID, min, max, step values of a parameter
     *
     * @var \horstoeko\musiccast\models\MusiccastDeviceFeatureRangeModel
     */
    public $rangeStep;

    /**
     * Returns information related to Preset
     *
     * @var \horstoeko\musiccast\models\MusiccastDeviceFeaturePresetModel
     */
    public $preset;
}
