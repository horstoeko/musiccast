<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\transformers;

use horstoeko\musiccast\models\MusiccastDeviceFeatureModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureNetUsbModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureSystemModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureTunerModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureZoneModel;
use Karriere\JsonDecoder\Bindings\ArrayBinding;
use Karriere\JsonDecoder\Bindings\FieldBinding;
use Karriere\JsonDecoder\ClassBindings;
use Karriere\JsonDecoder\Transformer;

/**
 * Class representing the transformer for the MusiccastDeviceFeatureModel
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new FieldBinding('system', 'system', MusiccastDeviceFeatureSystemModel::class));
        $classBindings->register(new ArrayBinding('zones', 'zone', MusiccastDeviceFeatureZoneModel::class));
        $classBindings->register(new FieldBinding('tuner', 'tuner', MusiccastDeviceFeatureTunerModel::class));
        $classBindings->register(new FieldBinding('netusb', 'netusb', MusiccastDeviceFeatureNetUsbModel::class));
    }

    public function transforms()
    {
        return MusiccastDeviceFeatureModel::class;
    }
}