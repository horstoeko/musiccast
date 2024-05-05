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
use horstoeko\musiccast\models\MusiccastNetUsbSettingsModel;
use horstoeko\musiccast\models\MusiccastNetUsbSettingsQobuzModel;

/**
 * Class representing the transformer for the MusiccastNetUsbSettingsModel
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbSettingsTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new FieldBinding('qobuz', 'qobuz', MusiccastNetUsbSettingsQobuzModel::class));
    }

    public function transforms()
    {
        return MusiccastNetUsbSettingsModel::class;
    }
}
