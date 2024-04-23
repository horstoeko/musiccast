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
use horstoeko\musiccast\models\MusiccastTidalModel;
use horstoeko\musiccast\models\MusiccastPresetModel;
use horstoeko\musiccast\models\MusiccastPlaylistModel;
use horstoeko\musiccast\models\MusiccastPlayQueueModel;
use horstoeko\musiccast\models\MusiccastRecentInfoModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureNetUsbModel;

/**
 * Class representing the transformer for the MusiccastDeviceFeatureNetUsbModel
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceFeatureNetUsbTransformer implements Transformer
{
    public function register(ClassBindings $classBindings)
    {
        $classBindings->register(new FieldBinding('preset', 'preset', MusiccastPresetModel::class));
        $classBindings->register(new FieldBinding('recentInfo', 'recent_info', MusiccastRecentInfoModel::class));
        $classBindings->register(new FieldBinding('playQueue', 'play_queue', MusiccastPlayQueueModel::class));
        $classBindings->register(new FieldBinding('mcPlaylist', 'mc_playlist', MusiccastPlaylistModel::class));
        $classBindings->register(new FieldBinding('tidal', 'tidal', MusiccastTidalModel::class));
    }

    public function transforms()
    {
        return MusiccastDeviceFeatureNetUsbModel::class;
    }
}