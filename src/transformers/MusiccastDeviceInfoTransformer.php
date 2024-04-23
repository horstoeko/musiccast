<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\transformers;

use horstoeko\musiccast\models\MusiccastAnalyticsInfoModel;
use horstoeko\musiccast\models\MusiccastDeviceInfoModel;
use Karriere\JsonDecoder\Bindings\FieldBinding;
use Karriere\JsonDecoder\ClassBindings;
use Karriere\JsonDecoder\Transformer;

/**
 * Class representing the transformer for the MusiccastDeviceInfoModel
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceInfoTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new FieldBinding('analyticsInfo', 'analytics_info', MusiccastAnalyticsInfoModel::class));
    }

    public function transforms()
    {
        return MusiccastDeviceInfoModel::class;
    }
}