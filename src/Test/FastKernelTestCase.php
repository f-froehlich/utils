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


use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class FastKernelTestCase
 *
 * @author  Fabian Fröhlich <mail@f-froehlich.de>
 * @package FabianFroehlich\Core\Util\Test
 */
class FastKernelTestCase
    extends KernelTestCase {

    use TestTrait;


    /** @var ContainerInterface */
    protected $containerStore;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void {

        parent::setUp();

        $this->init();
    }

    /**
     * Provide kernel and container
     */
    protected function init(): void {
        self::$kernel = KernelStore::getKernel();
        if (null === self::$kernel) {
            KernelStore::setKernel(self::bootKernel());
            self::$kernel = KernelStore::getKernel();
            ContainerStore::setContainer(self::$kernel->getContainer());
        }
        $this->containerStore = ContainerStore::getContainer();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void {

        parent::tearDown();
    }

    /**
     * Holt einen Service aus dem Dependency-Injection Container.
     *
     * @param $serviceId
     *
     * @return mixed
     * @throws ServiceNotFoundException
     * @throws ServiceCircularReferenceException
     */
    public function createService($serviceId) {

        return $this::$container->get($serviceId);
    }

    /**
     * @return KernelInterface
     */
    protected function getKernel(): KernelInterface {

        return self::$kernel;
    }

    /**
     * @param $class
     *
     * @return mixed
     */
    protected function getContainer($class) {

        return $this->containerStore->get($class);
    }

}