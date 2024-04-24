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
use horstoeko\musiccast\models\MusiccastDeviceFeatureNetUsbTidalModel;
use horstoeko\musiccast\models\MusiccastDeviceFeaturePresetModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureNetUsbMcPlaylistModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureNetUsbPlayQueueModel;
use horstoeko\musiccast\models\MusiccastDeviceFeatureNetUsbRecentInfoModel;
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
        $classBindings->register(new FieldBinding('preset', 'preset', MusiccastDeviceFeaturePresetModel::class));
        $classBindings->register(new FieldBinding('recentInfo', 'recent_info', MusiccastDeviceFeatureNetUsbRecentInfoModel::class));
        $classBindings->register(new FieldBinding('playQueue', 'play_queue', MusiccastDeviceFeatureNetUsbPlayQueueModel::class));
        $classBindings->register(new FieldBinding('mcPlaylist', 'mc_playlist', MusiccastDeviceFeatureNetUsbMcPlaylistModel::class));
        $classBindings->register(new FieldBinding('tidal', 'tidal', MusiccastDeviceFeatureNetUsbTidalModel::class));
    }

    public function transforms()
    {
        return MusiccastDeviceFeatureNetUsbModel::class;
    }
}