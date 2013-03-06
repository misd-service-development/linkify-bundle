<?php

/*
 * This file is part of the Symfony2 LinkifyBundle.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\LinkifyBundleBundle\Tests\DependencyInjection;

use Misd\LinkifyBundle\Tests\AbstractTestCase;

class ContainerTest extends AbstractTestCase
{
    public function testDefault(array $config = array())
    {
        $container = $this->getContainer(array($config));

        $this->assertTrue($container->has('misd.linkify'));
        $this->assertInstanceOf('Misd\Linkify\Linkify', $container->get('misd.linkify'));

        $this->assertTrue($container->has('templating.helper.linkify'));
        $this->assertInstanceOf(
            'Misd\LinkifyBundle\Helper\LinkifyHelper',
            $container->get('templating.helper.linkify')
        );
        $this->assertTrue($container->getDefinition('templating.helper.linkify')->hasTag('templating.helper'));

        $this->assertTrue($container->has('twig.extension.linkify'));
        $this->assertInstanceOf(
            'Misd\LinkifyBundle\Twig\Extension\LinkifyTwigExtension',
            $container->get('twig.extension.linkify')
        );
        $this->assertTrue($container->getDefinition('twig.extension.linkify')->hasTag('twig.extension'));
    }
}
