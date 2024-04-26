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
use horstoeko\musiccast\models\MusiccastLocationInfoModel;
use horstoeko\musiccast\models\MusiccastLocationInfoZonelistModel;

/**
 * Class representing the transformer for the MusiccastLocationInfoModel
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastLocationInfoTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new FieldBinding('zoneList', 'zone_list', MusiccastLocationInfoZonelistModel::class));
    }

    public function transforms()
    {
        return MusiccastLocationInfoModel::class;
    }
}
