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

namespace FabianFroehlich\Core\Util\Enum;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;
use UnexpectedValueException;
use function get_class;

/**
 * Class AbstractEnum
 *
 * @author  Fabian Fröhlich <mail@f-froehlich.de>
 * @package FabianFroehlich\Core\Util\Enum
 */
abstract class AbstractEnum {

    /** @var ArrayCollection|[] */
    protected static $all = [];
    /** @var ArrayCollection|[] */
    protected static $values = [];
    /** @var mixed */
    protected $value;
    /** @var string */
    protected $key;

    /**
     * AbstractEnum constructor.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @throws InvalidArgumentException
     */
    final protected function __construct($key, $value) {
        $this->key   = $key;
        $this->value = $value;
    }

    /**
     * @param string $method
     * @param array  $args
     *
     * @return null|static
     *
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public static function __callStatic($method, $args) {

        return static::get($method);
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     *
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public static function get($key) {

        $allValues = self::getAll();

        if ($allValues->containsKey($key)) {
            return $allValues->get($key);
        }

        return null;
    }

    /**
     * @return Collection|self[]
     *
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public static function getAll() {

        if (!isset(self::$all[static::class])) {

            self::$all[static::class] = new ArrayCollection();

            $reflection = new ReflectionClass(static::class);

            foreach ($reflection->getConstants() as $key => $value) {
                self::$all[static::class]->set($key, new static($key, $value));
            }

        }

        return self::$all[static::class];
    }

    /**
     * @return Collection|self[]
     *
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public static function getValues() {

        if (!isset(self::$values[static::class])) {

            self::$values[static::class] = new ArrayCollection();

            $reflection = new ReflectionClass(static::class);

            foreach ($reflection->getConstants() as $key => $value) {
                self::$values[static::class]->set($key, $value);
            }

        }

        return self::$values[static::class];
    }

    /**
     * @param $value
     *
     * @return static|null
     *
     * @throws InvalidArgumentException
     * @throws UnexpectedValueException
     * @throws ReflectionException
     */
    public static function fromValue($value): ?self {

        $possibleClients = static::getAll()->filter(
            function (AbstractEnum $enum) use ($value) {
                return $enum->value() === $value;
            }
        );


        switch ($possibleClients->count()) {
            case 1:
                return $possibleClients->first();
            case 0:
                return null;
            default:
                throw new UnexpectedValueException('The value "' . $value . '" exist at least twice!');
        }
    }

    /**
     * @return mixed
     */
    public function value() {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string {
        return $this->key();
    }

    /**
     * @return string
     */
    public function key(): string {
        return $this->key;
    }

    /**
     * @param AbstractEnum $other
     *
     * @return bool
     */
    public function equalsTo(AbstractEnum $other): bool {

        if (get_class($other) === get_class($this)) {
            return $other->value() === $this->value();
        }

        return false;
    }

    /**
     * Vergleicht den Value des Enum.
     *
     * @param int|float|string $scalarValue
     *
     * @return bool true, gdw. der value gleich ist.
     */
    public function isValueEquals($scalarValue): bool {
        return $this->value === $scalarValue;
    }
}