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
use Karriere\JsonDecoder\Bindings\FieldBinding;
use horstoeko\musiccast\models\MusiccastRangeModel;
use horstoeko\musiccast\models\MusiccastPresetModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureTunerModel;

/**
 * Class representing the transformer for the MusiccastDeviceFeatureTunerModel
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureTunerTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new ArrayBinding('rangeStep', 'range_step', MusiccastRangeModel::class));
        $classBindings->register(new FieldBinding('preset', 'preset', MusiccastPresetModel::class));
    }

    public function transforms()
    {
        return MusiccastDeviceFeatureTunerModel::class;
    }
}