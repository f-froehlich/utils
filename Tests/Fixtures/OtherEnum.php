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

namespace FabianFroehlich\Core\Util\Tests\Fixtures;


use FabianFroehlich\Core\Util\Enum\AbstractEnum;

/**
 * Class OtherEnum
 *
 * @author  Fabian Fröhlich <mail@f-froehlich.de>
 * @method static OtherEnum ONE()
 * @method static OtherEnum TWO()
 * @method static OtherEnum THREE()
 * @method static OtherEnum DUPLICATE_OF_THREE()
 * @package FabianFroehlich\Core\Util\Tests\Fixtures
 */
class OtherEnum
    extends AbstractEnum {

    /** @const string */
    private const ONE = 'ONE';

    /** @const string */
    private const TWO = 'TWO';

    /** @const string */
    private const THREE = 'THREE';

    /** @const string */
    private const DUPLICATE_OF_THREE = 'THREE';


}