<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast;

use GuzzleHttp\Client;
use Karriere\JsonDecoder\JsonDecoder;
use horstoeko\musiccast\models\MusiccastBaseModelWithReturnCode;
use horstoeko\musiccast\transformers\MusiccastDeviceInfoTransformer;
use horstoeko\musiccast\transformers\MusiccastDeviceFeatureTransformer;
use horstoeko\musiccast\transformers\MusiccastTunerPresetInfoTransformer;
use horstoeko\musiccast\transformers\MusiccastNetUsbPresetInfoTransformer;
use horstoeko\musiccast\transformers\MusiccastDeviceFeatureZoneTransformer;
use horstoeko\musiccast\transformers\MusiccastDeviceFeatureTunerTransformer;
use horstoeko\musiccast\transformers\MusiccastDeviceFeatureNetUsbTransformer;
use horstoeko\musiccast\transformers\MusiccastDeviceFeatureSystemTransformer;

/**
 * Class representing the device connection
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastConnection
{
    /**
     * The configuration
     *
     * @var \horstoeko\musiccast\MusiccastConfiguration
     */
    private $configuration = null;

    /**
     * The internal http client
     *
     * @var \GuzzleHttp\Client
     */
    private $httpClient = null;

    /**
     * Internal composer
     *
     * @var \Karriere\JsonDecoder\JsonDecoder
     */
    private $jsonDecoder = null;

    /**
     * The current zone
     *
     * @var string
     */
    private $currentZone = "main";

    /**
     * Constructor
     *
     * @param MusiccastConfiguration $configuration
     */
    public function __construct(MusiccastConfiguration $configuration)
    {
        $this->configuration = $configuration;

        $this->createHttpClient();
        $this->createJsonDecoder();
    }

    /**
     * Create internal http client
     *
     * @return void
     */
    private function createHttpClient(): void
    {
        $this->httpClient = new Client([
            'base_uri' => sprintf("http://%s/YamahaExtendedControl/v3/", $this->configuration->getHostNameOrIp()),
            'timeout' => 5.0
        ]);
    }

    /**
     * Create internal JSON decoder
     *
     * @return void
     */
    private function createJsonDecoder(): void
    {
        $this->jsonDecoder = new JsonDecoder(true);

        $this->jsonDecoder->register(new MusiccastDeviceInfoTransformer());
        $this->jsonDecoder->register(new MusiccastDeviceFeatureTransformer());
        $this->jsonDecoder->register(new MusiccastDeviceFeatureSystemTransformer());
        $this->jsonDecoder->register(new MusiccastDeviceFeatureZoneTransformer());
        $this->jsonDecoder->register(new MusiccastDeviceFeatureTunerTransformer());
        $this->jsonDecoder->register(new MusiccastDeviceFeatureNetUsbTransformer());
        $this->jsonDecoder->register(new MusiccastTunerPresetInfoTransformer());
        $this->jsonDecoder->register(new MusiccastNetUsbPresetInfoTransformer());
    }

    /**
     * Get the current device's zone
     *
     * @return string
     */
    public function getZone(): string
    {
        return $this->currentZone;
    }

    /**
     * Set the device's zone
     *
     * @param string $newZone
     * @return void
     */
    public function setZone(string $newZone): void
    {
        if ($newZone == "") {
            return;
        }

        $this->currentZone = $newZone;
    }

    /**
     * Perform GET-Request
     *
     * @param string $uri
     * @param string $modelClass
     * @return MusiccastBaseModelWithReturnCode
     */
    public function requestGet(string $uri, string $modelClass): MusiccastBaseModelWithReturnCode
    {
        $response = $this->httpClient->request("GET", $uri);

        /**
         * @var MusiccastBaseModelWithReturnCode
         */
        $responseObject = $this->jsonDecoder->decode($response->getBody()->getContents(), $modelClass);
        $responseObject->throwIfFailed();

        return $responseObject;
    }
}
