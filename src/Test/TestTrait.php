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
 * Trait TestTrait
 *
 * @author  Fabian Fröhlich <mail@f-froehlich.de>
 * @package FabianFroehlich\Core\Util\Test
 */
trait TestTrait {

    /**
     * This method can stop a test and wait for enter input
     *
     * @param array $messages
     */
    public function waitForEnter(array $messages = []): void {

        if ($messages) {
            foreach ($messages as $message) {
                echo $message . "\n";
            }
        }

        echo "\n";

        echo 'Test stopped. Press ENTER to continue';
        ob_flush();
        $handle = fopen('php://stdin', 'rb');
        fgets($handle);
        fclose($handle);

        echo "\n";
        ob_flush();
    }


}