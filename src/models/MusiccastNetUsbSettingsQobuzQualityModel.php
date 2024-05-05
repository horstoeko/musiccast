<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the response of the getSetting's qobutz (Net/Usb)
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastNetUsbSettingsQobuzQualityModel extends MusiccastBaseModel
{
    /**
     * Returns current Streaming Quality
     *
     * Values:
     * - "hr_192_24" (HiRes - 24bits / up to 192kHz)
     * - "hr_96_24" (HiRes - 24bits / up to 96kHz)
     * - "cd_44_16" (CD - 16bits / 44.1kHz)
     * - "mp3_320" (MP3 - 320kbps)
     *
     * @var string
     */
    public $value = "";

    /**
     * List of Streaming Quality available
     *
     * @var \horstoeko\musiccast\models\MusiccastNetUsbSettingsQobuzQualityValueModel[]
     */
    public $valueList = [];

    /**
     * Returns a list of selectable qualities
     *
     * @return string[]
     */
    public function getAllowedQualities(): array
    {
        return array_map(
            function (MusiccastNetUsbSettingsQobuzQualityValueModel $item) {
                return $item->value;
            }, array_filter(
                $this->valueList, function (MusiccastNetUsbSettingsQobuzQualityValueModel $item) {
                    return $item->attribute & (1 << 0);
                }
            )
        );
    }
}
