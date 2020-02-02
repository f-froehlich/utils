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


use FabianFroehlich\Core\Util\Enum\RegExp;
use FabianFroehlich\Core\Util\Test\AbstractEnumTestCase;

/**
 * Class RegExpTest
 *
 * @author  Fabian Fröhlich <mail@f-froehlich.de>
 * @package FabianFroehlich\Core\Util\Tests\Unit
 */
class RegExpTest
    extends AbstractEnumTestCase {

    /**
     * @test
     */
    public function validPasswordWillAccepted(): void {

        $validPasswords = file(__DIR__ . '/../Fixtures/validPasswords.txt', FILE_IGNORE_NEW_LINES);

        foreach ($validPasswords as $validPassword) {
            $this->assertRegExp(RegExp::PASSWORD()->value(), $validPassword);
        }
    }

    /**
     * @test
     */
    public function invalidPasswordWillNotAccepted(): void {

        $invalidPasswords = file(__DIR__ . '/../Fixtures/invalidPasswords.txt', FILE_IGNORE_NEW_LINES);

        foreach ($invalidPasswords as $invalidPassword) {
            $this->assertNotRegExp(RegExp::PASSWORD()->value(), $invalidPassword);
        }
    }

    /**
     * @test
     */
    public function validEmailWillAccepted(): void {

        $validPasswords = file(__DIR__ . '/../Fixtures/validEmail.txt', FILE_IGNORE_NEW_LINES);

        foreach ($validPasswords as $validPassword) {
            $this->assertRegExp(RegExp::EMAIL()->value(), $validPassword);
        }
    }

    /**
     * @test
     */
    public function invalidEmailWillNotAccepted(): void {

        $invalidPasswords = file(__DIR__ . '/../Fixtures/invalidEmail.txt', FILE_IGNORE_NEW_LINES);

        foreach ($invalidPasswords as $invalidPassword) {
            $this->assertNotRegExp(RegExp::EMAIL()->value(), $invalidPassword);
        }
    }

    protected function getEnumProps(): array {
        return [
            'EMAIL'       => '/^(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\ x01\-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/',
            'EMAIL_FE'    => '^(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\ x01\-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$',
            'PASSWORD'    => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[\W])(?=.{10,})/',
            'PASSWORD_FE' => '^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[\W])(?=.{10,})',
        ];
    }

    protected function getEnumClass(): string {
        return RegExp::class;
    }
}