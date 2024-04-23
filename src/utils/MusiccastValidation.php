<?php

/**
 * This file is a part of horstoeko/musiccast.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace horstoeko\musiccast\utils;

use InvalidArgumentException;

/**
 * Class representing validations utilities
 *
 * @category MusicCast
 * @package  MusicCast
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/musiccast
 */
class MusiccastValidation
{
    /**
     * Check eleemnt exists in items
     *
     * @param array $allowedItems
     * @param mixed $value
     * @return void
     */
    public static function testInArray(array $allowedItems, $value): void
    {
        if (in_array($value, $allowedItems)) {
            return;
        }

        $allowedItemsText = implode(", ", $allowedItems);

        throw new InvalidArgumentException("Unknown value {$value}. Select a value from [{$allowedItemsText}]");
    }

    /**
     * Check if $value is between $min and $max
     *
     * @param integer $value
     * @param integer $min
     * @param integer $max
     * @return void
     */
    public static function testIntValueBetween(int $value, int $min, int $max): void
    {
        if ($value >= $min && $value <= $max) {
            return;
        }

        throw new InvalidArgumentException("The value must be between {$min} and {$max}. Current value is {$value}");
    }
}
