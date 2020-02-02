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

/**
 * Class AbstractEnumTestCase
 *
 * @author  Fabian Fröhlich <mail@f-froehlich.de>
 * @package FabianFroehlich\Core\Util\Test
 */
abstract class AbstractEnumTestCase
    extends UnitTestCase {

    /**
     * @test
     */
    public function toStringWillReturnKeys(): void {
        foreach ($this->getEnumProps() as $key => $value) {
            $this->assertEquals($key, $this->getEnumClass()::$key()->__toString());
        }
    }

    /**
     * Get a map of all Enum props with values
     *
     * @return array
     */
    abstract protected function getEnumProps(): array;

    /**
     * Get the enum class for test
     *
     * @return string
     */
    abstract protected function getEnumClass(): string;

    /**
     * @test
     */
    public function valueWillGetExpectedValue(): void {
        foreach ($this->getEnumProps() as $key => $value) {
            $this->assertEquals($value, $this->getEnumClass()::$key()->value());
        }
    }

    /**
     * @test
     */
    public function keyWillReturnExpectedKey(): void {
        foreach ($this->getEnumProps() as $key => $value) {
            $this->assertEquals($key, $this->getEnumClass()::$key()->key());
        }
    }

    /**
     * @test
     */
    public function equalsToWillEqualSelf(): void {
        foreach ($this->getEnumProps() as $key => $value) {
            $this->assertTrue($this->getEnumClass()::$key()->equalsTo($this->getEnumClass()::$key()));
        }
    }

    /**
     * @test
     */
    public function equalsToWillNotEqualOtherOfSameClass(): void {
        foreach ($this->getEnumProps() as $key => $value) {
            foreach ($this->getEnumProps() as $other => $otherValue) {
                if ($key === $other) {
                    $this->assertTrue($this->getEnumClass()::$key()->equalsTo($this->getEnumClass()::$other()));
                    continue;
                }
                $this->assertFalse($this->getEnumClass()::$key()->equalsTo($this->getEnumClass()::$other()));
            }
        }
    }

    /**
     * @test
     */
    public function valueEqualsToWillNotEqualOtherOfSameClass(): void {
        foreach ($this->getEnumProps() as $key => $value) {
            foreach ($this->getEnumProps() as $other => $otherValue) {
                if ($key === $other) {
//                    $this->assertTrue($this->getEnumClass()::$key()->isValueEquals($other));

                    continue;
                }
                $this->assertFalse($this->getEnumClass()::$key()->isValueEquals($other));
            }
        }
    }

    /**
     * @test
     */
    public function getAllWillReturnAll(): void {
        $allEnums = $this->getEnumClass()::getAll()->toArray();
        $this->assertCount(count($this->getEnumProps()), $allEnums);

        foreach ($this->getEnumProps() as $key => $value) {
            $this->assertContains($this->getEnumClass()::$key(), $allEnums);
        }
    }

    /**
     * @test
     */
    public function getValuesWillReturnAllValues(): void {
        $allEnums = $this->getEnumClass()::getValues()->toArray();
        $this->assertCount(count($this->getEnumProps()), $allEnums);

        foreach ($this->getEnumProps() as $key => $value) {
            $this->assertContains($this->getEnumClass()::$key()->value(), $allEnums);
        }
    }

    /**
     * @test
     */
    public function getWillReturnRightConst(): void {

        foreach ($this->getEnumProps() as $key => $value) {
            $this->assertEquals($this->getEnumClass()::$key(), $this->getEnumClass()::get($key));
        }
    }

    /**
     * @test
     */
    public function callStaticWillReturnConstByNameIfExist(): void {

        foreach ($this->getEnumProps() as $key => $value) {
            $this->assertEquals($this->getEnumClass()::$key(), $this->getEnumClass()::__callStatic($key, null));
        }
    }

    /**
     * @test
     */
    public function getWillReturnNullIfNotDefined(): void {

        $this->assertNull($this->getEnumClass()::get(time()));
    }


    /**
     * @test
     */
    public function fromValueWilReturnConst(): void {

        foreach ($this->getEnumProps() as $key => $value) {
            $this->assertEquals($this->getEnumClass()::$key(), $this->getEnumClass()::fromValue($value));
        }
    }

    /**
     * @test
     */
    public function fromValueWilReturnNullIfNotDefined(): void {
        $this->assertNull($this->getEnumClass()::fromValue(time()));
    }

}