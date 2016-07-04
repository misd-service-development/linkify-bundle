<?php

/*
 * This file is part of the Symfony LinkifyBundle.
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

        
        $linkifyFilters = array_filter($filters, function (\Twig_SimpleFilter $filter) {
            return $filter->getName() === 'linkify';
        });

        $this->assertCount(1, $linkifyFilters);
    }

    public function testLinkify()
    {
        $text = 'test';
        $options = array('key' => 'value');

        $linkify = $this->getMock('Misd\Linkify\Linkify');
        $helper = $this->getMock('Misd\LinkifyBundle\Helper\LinkifyHelper', array('process'), array($linkify));
        $helper->expects($this->once())->method('process')->with($text, $options);

        $extension = new LinkifyTwigExtension($helper);

        $extension->linkify($text, $options);
    }

    public function testName()
    {
        $linkify = $this->getMock('Misd\Linkify\Linkify');
        $helper = $this->getMock('Misd\LinkifyBundle\Helper\LinkifyHelper', array(), array($linkify));

        $extension = new LinkifyTwigExtension($helper);

        $this->assertTrue(is_string($extension->getName()));
    }
}
