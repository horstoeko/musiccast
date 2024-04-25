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
use horstoeko\musiccast\models\MusiccastTunerPresetInfoModel;
use horstoeko\musiccast\models\MusiccastTunerPresetInfoItemModel;
use Karriere\JsonDecoder\Bindings\ArrayBinding;

/**
 * Class representing the transformer for the MusiccastTunerPresetInfoModel
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastTunerPresetInfoTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new ArrayBinding('presetInfo', 'preset_info', MusiccastTunerPresetInfoItemModel::class));
    }

    public function transforms()
    {
        return MusiccastTunerPresetInfoModel::class;
    }
}
