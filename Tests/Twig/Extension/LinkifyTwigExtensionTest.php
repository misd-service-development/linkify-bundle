<?php

/*
 * This file is part of the Symfony2 LinkifyBundle.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\LinkifyBundle\Tests\Twig\Extension;

use Misd\LinkifyBundle\Tests\AbstractTestCase;
use Misd\LinkifyBundle\Twig\Extension\LinkifyTwigExtension;

class LinkifyTwigExtensionTest extends AbstractTestCase
{
    public function testConstructor()
    {
        $linkify = $this->getMock('Misd\Linkify\Linkify');
        $helper = $this->getMock('Misd\LinkifyBundle\Helper\LinkifyHelper', array(), array($linkify));

        $extension = new LinkifyTwigExtension($helper);

        $this->assertInstanceOf('Twig_Extension', $extension);
        $this->assertSame($helper, $this->readAttribute($extension, 'helper'));
    }

    public function testFilters()
    {
        $linkify = $this->getMock('Misd\Linkify\Linkify');
        $helper = $this->getMock('Misd\LinkifyBundle\Helper\LinkifyHelper', array(), array($linkify));

        $extension = new LinkifyTwigExtension($helper);

        $filters = $extension->getFilters();

        $this->assertArrayHasKey('linkify', $filters);
        $this->assertInstanceOf('Twig_Filter_Method', $filters['linkify']);
    }

    public function testLinkify()
    {
        $linkify = $this->getMock('Misd\Linkify\Linkify');
        $helper = $this->getMock('Misd\LinkifyBundle\Helper\LinkifyHelper', array('process'), array($linkify));
        $helper->expects($this->once())->method('process');

        $extension = new LinkifyTwigExtension($helper);

        $extension->linkify('test');
    }

    public function testName()
    {
        $linkify = $this->getMock('Misd\Linkify\Linkify');
        $helper = $this->getMock('Misd\LinkifyBundle\Helper\LinkifyHelper', array(), array($linkify));

        $extension = new LinkifyTwigExtension($helper);

        $this->assertTrue(is_string($extension->getName()));
    }
}
