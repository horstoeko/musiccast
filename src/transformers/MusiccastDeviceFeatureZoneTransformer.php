<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\transformers;

use horstoeko\musiccast\models\MusiccastDeviceFeatureZoneModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureRangeModel;
use Karriere\JsonDecoder\Bindings\ArrayBinding;
use Karriere\JsonDecoder\ClassBindings;
use Karriere\JsonDecoder\Transformer;

/**
 * Class representing the transformer for the MusiccastDeviceFeatureZoneModel
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureZoneTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new ArrayBinding('rangeStep', 'range_step', MusiccastDeviceFeatureRangeModel::class));
    }

    public function transforms()
    {
        return MusiccastDeviceFeatureZoneModel::class;
    }
}
