<?php
/**
 * Utils
 *
 * This Repository contains some useful Stuff for my Projects
 *
 * Copyright (c) 2020 Fabian Fröhlich <mail@f-froehlich.de> https://f-froehlich.de
 *
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * For all license terms see README.md and LICENSE Files in root directory of this Project.
 *
 */

namespace FabianFroehlich\Core\Util\Test;

use Exception;
use LogicException;

/**
 * Class RandomValueGenerator
 *
 * @author  Fabian Fröhlich <mail@f-froehlich.de>
 * @package FabianFroehlich\Core\Util\Test
 */
class RandomValueGenerator {

    /**
     * Create an random String with given length. Use random Length, if range given
     *
     * @param int $minLength
     * @param int $maxLength
     *
     * @return string
     * @throws Exception
     */
    public static function createRandomString(int $minLength = 0, int $maxLength = 100): string {

        if ($maxLength < $minLength) {
            throw new LogicException('Max length cant be lower than min length');
        }

        $arr    = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        $length = random_int($minLength, $minLength);
        $str    = '';

        for ($i = 0; $i < $length; $i++) {
            shuffle($arr);
            $str .= $arr[0];
        }

        return $str;

    }

    /**
     * @param int $min
     * @param int $max
     *
     * @return int
     * @throws Exception
     */
    public static function createRandomInt(int $min = PHP_INT_MIN, int $max = PHP_INT_MAX): int {

        if ($max < $min) {
            throw new LogicException('Max length cant be lower than min length');
        }

        return random_int($min, $max);
    }

    /**
     * @param int $min
     *
     * @return int
     * @throws Exception
     */
    public static function createRandomNegativeInt(int $min = PHP_INT_MIN): int {

        if (0 < $min) {
            throw new LogicException('min must be lower than 0');
        }

        return random_int($min, 0);
    }


    /**
     * @param int $max
     *
     * @return int
     * @throws Exception
     */
    public static function createRandomPositiveInt(int $max = PHP_INT_MAX): int {

        if ($max < 0) {
            throw new LogicException('max must be greater than 0');
        }

        return random_int(0, $max);
    }

    /**
     * @param int $min
     * @param int $max
     *
     * @return float|int
     */
    public static function createRandomFloat(int $min = PHP_FLOAT_MIN, int $max = PHP_FLOAT_MAX) {
        if ($max < $min) {
            throw new LogicException('Max length cant be lower than min length');
        }

        return $max - $min === 0.0
            ? ($min - 1 + ($max - $min + 1) * (mt_rand() / mt_getrandmax()))
            : ($min + ($max - $min) * (mt_rand() / mt_getrandmax()));
    }
}