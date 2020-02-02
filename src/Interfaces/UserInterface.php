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

namespace FabianFroehlich\Core\Util\Interfaces;

/**
 * Interface UserInterface
 *
 * @author  Fabian Fröhlich <mail@f-froehlich.de>
 * @package FabianFroehlich\Core\Util\Interfaces
 */
interface UserInterface
    extends EntityInterface {

    public function isConfirmed(): bool;

    public function setConfirmed(bool $confirmed): self;

    public function getFirstName(): string;

    public function setFirstName(string $name): self;

    public function getLastName(): string;

    public function setLastName(string $name): self;

    public function getEmail(): string;

    public function setEmail(string $name): self;

    public function getUsername(): ?string;

    public function setUsername(?string $name): self;

    public function getPassword(): string;

    public function setPassword(string $password): self;

    public function getLanguage(): string;

    public function setLanguage(string $name): self;

    public function getDescription(): string;

    public function setDescription(string $name): self;

}