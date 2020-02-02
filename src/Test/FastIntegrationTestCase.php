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
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class FastIntegrationTestCase
 *
 * @author  Fabian Fröhlich <mail@f-froehlich.de>
 * @package FabianFroehlich\Core\Util\Test
 */
abstract class FastIntegrationTestCase
    extends UnitTestCase {

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

        $this->containerStore = ContainerStore::getContainer();

        if (null === $this->containerStore) {
            ContainerStore::setContainer($this->initContainer());
            $this->containerStore = ContainerStore::getContainer();
        }
    }

    /**
     * @return ContainerBuilder
     */
    protected function initContainer(): ContainerBuilder {

        $container = $this->createContainer(['kernel.debug' => true]);
        $this->loadExtensions($container);
        $container->compile();

        return $container;
    }

    private function createContainer(array $data = []): ContainerBuilder {

        return new ContainerBuilder(
            new ParameterBag(
                array_merge(
                    [
                        'kernel.bundles'                                 => $this->getBundles(),
                        'kernel.bundles_metadata'                        => $this->getBundlesMetadata(),
                        'kernel.cache_dir'                               => __DIR__,
                        'kernel.project_dir'                             => __DIR__,
                        'kernel.root_dir'                                => __DIR__,
                        'env(base64:default::SYMFONY_DECRYPTION_SECRET)' => __DIR__,
                        'kernel.debug'                                   => false,
                        'kernel.environment'                             => 'test',
                        'kernel.charset'                                 => 'UTF-8',
                        'kernel.secret'                                  => 'secret',
                        'kernel.name'                                    => 'kernel',
                        'kernel.container_class'                         => 'testContainer',
                        'container.build_hash'                           => 'Abc1234',
                        'container.build_id'                             => hash('crc32', 'Abc123423456789'),
                        'container.build_time'                           => 23456789,
                    ],
                    $data
                )
            )
        );
    }

    abstract protected function getBundles(): array;

    abstract protected function getBundlesMetadata(): array;

    abstract protected function loadExtensions(ContainerInterface $container);

    /**
     * @param $class
     *
     * @return mixed
     */
    protected function getContainer($class) {

        return $this->containerStore->get($class);
    }

}