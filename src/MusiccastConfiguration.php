<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast;

/**
 * Class representing the configuration
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastConfiguration
{
    /**
     * The devices IP or hostname to communicate with
     *
     * @var string
     */
    private $hostNameOrIp = "";

    /**
     * Retrieve the devices hostname or IP
     *
     * @return string
     */
    public function getHostNameOrIp(): string
    {
        return $this->hostNameOrIp;
    }

    /**
     * Set the devives hostname or IP
     *
     * @param string $newHostnameOrIp
     * @return void
     */
    public function setHostNameOrIp(string $newHostnameOrIp): void
    {
        $this->hostNameOrIp = $newHostnameOrIp;
    }
}