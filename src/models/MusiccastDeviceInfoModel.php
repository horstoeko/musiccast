<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

/**
 * Class representing the device info
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastDeviceInfoModel extends MusiccastBaseModelWithReturnCode
{
    /**
     * Model name
     *
     * @var string
     */
    public $modelName = "";

    /**
     * Device’s destination region code
     *
     * @var string
     */
    public $destination = "";

    /**
     * Device’s ID (12 digit ASCII).Device ID is unique ID to identify Device
     *
     * @var string
     */
    public $deviceId = "";

    /**
     * System Id
     *
     * @var string
     */
    public $systemId = "";

    /**
     * System version
     *
     * @var float
     */
    public $systemVersion = 0.0;

    /**
     * API version
     *
     * @var float
     */
    public $apiVersion = 0.0;

    /**
     * Net Module Generation
     *
     * @var integer
     */
    public $netmoduleGeneration = 0;

    /**
     * Net Nodule Version
     *
     * @var string
     */
    public $netmoduleVersion = "";

    /**
     * Net Module Checksum
     *
     * @var string
     */
    public $netmoduleChecksum = "";

    /**
     * Serial Number
     *
     * @var string
     */
    public $serialNumber = "";

    /**
     * Categorry Code
     *
     * @var string
     */
    public $categoryCode = "";

    /**
     * Operation mode
     *
     * @var string
     */
    public $operationMode = "";

    /**
     * Update error code
     *
     * @var string
     */
    public $updateErrorCode = "";

    /**
     * Net Module Num
     *
     * @var integer
     */
    public $netModuleNum = 0;

    /**
     * Update Data Type
     *
     * @var integer
     */
    public $updateDataType = 0;

    /**
     * Analytics Info
     *
     * @var \horstoeko\musiccast\models\MusiccastAnalyticsInfoModel
     */
    public $analyticsInfo = null;
}