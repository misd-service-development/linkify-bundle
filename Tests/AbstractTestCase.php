<?php

/*
 * This file is part of the Symfony LinkifyBundle.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\LinkifyBundle\Tests;

use Misd\LinkifyBundle\MisdLinkifyBundle;
use PHPUnit_Framework_TestCase;
use Symfony\Component\DependencyInjection\Compiler\ResolveDefinitionTemplatesPass;
use Symfony\Component\DependencyInjection\Compiler\ResolveParameterPlaceHoldersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\KernelInterface;

class AbstractTestCase extends PHPUnit_Framework_TestCase
{
    protected function getContainer(array $config = array(), KernelInterface $kernel = null)
    {
        if (null === $kernel) {
            $kernel = $this->getMockBuilder('Symfony\Component\HttpKernel\KernelInterface')->getMock();
            $kernel
                ->expects($this->any())
                ->method('getBundles')
                ->will($this->returnValue(array()));
        }

        $bundle = new MisdLinkifyBundle($kernel);
        $extension = $bundle->getContainerExtension();

        $container = new ContainerBuilder();
        $container->setParameter('kernel.debug', true);
        $container->setParameter('kernel.cache_dir', sys_get_temp_dir() . '/linkify');
        $container->setParameter('kernel.bundles', array());
        $container->setParameter('kernel.root_dir', __DIR__ . '/Fixtures');
        $container->set('service_container', $container);

        $container->registerExtension($extension);
        $extension->load($config, $container);
        $bundle->build($container);

        $container->getCompilerPassConfig()->setOptimizationPasses(
            array(new ResolveParameterPlaceHoldersPass(), new ResolveDefinitionTemplatesPass())
        );
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->compile();

        return $container;
    }
}
