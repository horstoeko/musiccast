<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\models;

use RuntimeException;

/**
 * Class representing the base class for all operator models
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastBaseModelWithReturnCode
{
    /**
     * Request Response Code
     *
     * @var integer
     */
    public $responseCode = 0;

    /**
     * Returns true when the operatom was successfull
     *
     * @return boolean
     */
    public function isSuccessFull(): bool
    {
        return $this->responseCode === 0;
    }

    /**
     * Returns true when the operatom was not successfull
     *
     * @return boolean
     */
    public function isNotSuccessFull(): bool
    {
        return $this->responseCode !== 0;
    }

    /**
     * Throw an exception if the operation failed
     *
     * @return void
     * @throws RuntimeException
     */
    public function throwIfFailed(): void
    {
        if ($this->isNotSuccessFull() === true) {
            throw new RuntimeException($this->getOperationMessage());
        }
    }

    /**
     * Get an error text. Use together with isSuccessFull-method
     *
     * @return string
     */
    public function getOperationMessage(): string
    {
        $errorMessages[0] = "Successful request";
        $errorMessages[1] = "Initializing";
        $errorMessages[2] = "Internal Error";
        $errorMessages[3] = "Invalid Request (A method did not exist, a method wasn’t appropriate etc.)";
        $errorMessages[4] = "Invalid Parameter (Out of range, invalid characters etc.)";
        $errorMessages[5] = "Guarded (Unable to setup in current status etc.)";
        $errorMessages[6] = "Timeout";
        $errorMessages[99] = "Firmware Updating";
        $errorMessages[100] = "Access Error";
        $errorMessages[101] = "Other Errors";
        $errorMessages[102] = "Wrong Username";
        $errorMessages[103] = "Wrong Password";
        $errorMessages[104] = "Account expired";
        $errorMessages[105] = "Account Disconnected/Gone Off/Shut Down";
        $errorMessages[106] = "Account Number Reached to the Limit";
        $errorMessages[107] = "Server Maintenance";
        $errorMessages[108] = "Invalid Account";
        $errorMessages[109] = "License Error";
        $errorMessages[110] = "Read Only Mode";
        $errorMessages[111] = "Max Stations";
        $errorMessages[112] = "Access Denied";
        $errorMessages[113] = "There is a need to specify the additional destination Playlist";
        $errorMessages[114] = "There is a need to create a new Playlis";
        $errorMessages[115] = "Simultaneous logins has reached the upper limit";
        $errorMessages[200] = "Linking in progress";
        $errorMessages[201] = "Unlinking in progress";

        if (!isset($errorMessages[$this->responseCode])) {
            return sprintf("Unknown response code %s", $this->responseCode);
        }

        return $errorMessages[$this->responseCode];
    }
}
