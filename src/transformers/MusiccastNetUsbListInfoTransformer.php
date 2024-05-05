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
use horstoeko\musiccast\models\MusiccastNetUsbListInfoModel;
use horstoeko\musiccast\models\MusiccastNetUsbListInfoItemModel;

/**
 * Class representing the transformer for the MusiccastNetUsbPresetInfoModel
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbListInfoTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new ArrayBinding('listInfo', 'list_info', MusiccastNetUsbListInfoItemModel::class));
    }

    public function transforms()
    {
        return MusiccastNetUsbListInfoModel::class;
    }
}
