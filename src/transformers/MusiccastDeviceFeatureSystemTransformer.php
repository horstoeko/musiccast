<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\transformers;

use Karriere\JsonDecoder\Transformer;
use Karriere\JsonDecoder\ClassBindings;
use Karriere\JsonDecoder\Bindings\ArrayBinding;
use horstoeko\musiccast\models\MusiccastDeviceFeatureSystemInputModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureRangeModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureSystemModel;

/**
 * Class representing the transformer for the MusiccastDeviceFeatureSystemModel
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureSystemTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new ArrayBinding('inputList', 'input_list', MusiccastDeviceFeatureSystemInputModel::class));
        $classBindings->register(new ArrayBinding('rangeStep', 'range_step', MusiccastDeviceFeatureRangeModel::class));
    }

    public function transforms()
    {
        return MusiccastDeviceFeatureSystemModel::class;
    }
}
