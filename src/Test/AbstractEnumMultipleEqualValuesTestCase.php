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

use UnexpectedValueException;

/**
 * Class AbstractEnumMultipleEqualValuesTestCase
 *
 * @author  Fabian Fröhlich <mail@f-froehlich.de>
 * @package FabianFroehlich\Core\Util\Test
 */
abstract class AbstractEnumMultipleEqualValuesTestCase
    extends AbstractEnumTestCase {

    /**
     * @test
     */
    public function fromValueWilReturnConst(): void {

        $valueMappedList = $this->getEqualValuesKeys();

        foreach ($this->getEnumProps() as $key => $value) {
            if (isset($valueMappedList[$value])) {

                try {
                    $this->assertEquals($this->getEnumClass()::$key(), $this->getEnumClass()::fromValue($value));
                } catch (UnexpectedValueException $e) {
                    $this->assertEquals('The value "' . $value . '" exist at least twice!', $e->getMessage());
                }

            } else {
                $this->assertEquals($this->getEnumClass()::$key(), $this->getEnumClass()::fromValue($value));

            }
        }
    }

    /**
     * Get all Keys group by value, if value exist more then once in Enum
     *
     * @return array
     */
    final protected function getEqualValuesKeys(): array {

        $valueMappedList = [];

        foreach ($this->getEnumProps() as $enumKey => $enumProp) {
            $valueMappedList[$enumProp][] = $enumKey;
        }

        foreach ($valueMappedList as $key => $mappedList) {
            if (count($mappedList) <= 1) {
                unset($valueMappedList[$key]);
            }
        }

        return $valueMappedList;
    }

    /**
     * @test
     */
    public function equalsToWillNotEqualOtherOfSameClass(): void {

        $valueMappedList = $this->getEqualValuesKeys();

        foreach ($this->getEnumProps() as $key => $value) {
            foreach ($this->getEnumProps() as $other => $otherValue) {
                if ($key === $other) {
                    $this->assertTrue($this->getEnumClass()::$key()->equalsTo($this->getEnumClass()::$other()));
                } else {
                    if (isset($valueMappedList[$value])) {
                        foreach ($valueMappedList[$value] as $doubleKey) {
                            if ($key === $doubleKey || $other === $doubleKey) {
                                $this->assertTrue(
                                    $this->getEnumClass()::$key()->equalsTo($this->getEnumClass()::$doubleKey())
                                );
                            } else {
                                $this->assertFalse(
                                    $this->getEnumClass()::$key()->equalsTo($this->getEnumClass()::$other())
                                );
                            }
                        }

                    } else {
                        $this->assertFalse($this->getEnumClass()::$key()->equalsTo($this->getEnumClass()::$other()));
                    }
                }
            }
        }
    }

    /**
     * @test
     */
    public function valueEqualsToWillNotEqualOtherOfSameClass(): void {

        $valueMappedList = $this->getEqualValuesKeys();

        foreach ($this->getEnumProps() as $key => $value) {
            foreach ($this->getEnumProps() as $other => $otherValue) {

                if (isset($valueMappedList[$otherValue])) {
                    if ($value === $otherValue) {
                        $this->assertTrue($this->getEnumClass()::$key()->isValueEquals($otherValue));
                    } else {
                        $this->assertFalse($this->getEnumClass()::$key()->isValueEquals($otherValue));
                    }
                } else {
                    if ($key === $other) {
                        $this->assertTrue($this->getEnumClass()::$key()->isValueEquals($other));
                    } else {
                        $this->assertFalse($this->getEnumClass()::$key()->isValueEquals($other));
                    }
                }
            }
        }
    }


}