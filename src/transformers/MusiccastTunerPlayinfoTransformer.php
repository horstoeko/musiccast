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
use Karriere\JsonDecoder\Bindings\FieldBinding;
use horstoeko\musiccast\models\MusiccastTunerPlayinfoModel;
use horstoeko\musiccast\models\MusiccastTunerPlayinfoForAmModel;
use horstoeko\musiccast\models\MusiccastTunerPlayinfoForFmModel;
use horstoeko\musiccast\models\MusiccastTunerPlayinfoForDabModel;
use horstoeko\musiccast\models\MusiccastTunerPlayinfoForRdsModel;

/**
 * Class representing the transformer for the MusiccastNetUsbPresetInfoModel
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastTunerPlayinfoTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new FieldBinding('rds', 'rds', MusiccastTunerPlayinfoForAmModel::class));
        $classBindings->register(new FieldBinding('fm', 'fm', MusiccastTunerPlayinfoForFmModel::class));
        $classBindings->register(new FieldBinding('dab', 'dab', MusiccastTunerPlayinfoForDabModel::class));
        $classBindings->register(new FieldBinding('rds', 'rds', MusiccastTunerPlayinfoForRdsModel::class));
    }

    public function transforms()
    {
        return MusiccastTunerPlayinfoModel::class;
    }
}
