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

namespace FabianFroehlich\Core\Util\Tests\Unit;


use FabianFroehlich\Core\Util\Test\AbstractEnumMultipleEqualValuesTestCase;
use FabianFroehlich\Core\Util\Tests\Fixtures\OtherEnum;

/**
 * Class OtherEnumTest
 *
 * @author  Fabian Fröhlich <mail@f-froehlich.de>
 * @package FabianFroehlich\Core\Util\Tests\Unit
 */
class OtherEnumTest
    extends AbstractEnumMultipleEqualValuesTestCase {


    protected function getEnumProps(): array {
        return [
            'ONE'                => 'ONE',
            'TWO'                => 'TWO',
            'THREE'              => 'THREE',
            'DUPLICATE_OF_THREE' => 'THREE',
        ];
    }

    protected function getEnumClass(): string {
        return OtherEnum::class;
    }
}