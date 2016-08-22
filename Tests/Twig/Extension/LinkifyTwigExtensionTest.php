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
use Twig_SimpleFilter;

class LinkifyTwigExtensionTest extends AbstractTestCase
{
    public function testConstructor()
    {
        $linkify = $this->getMockBuilder('Misd\Linkify\Linkify')->getMock();
        $helper = $this->getMockBuilder('Misd\LinkifyBundle\Helper\LinkifyHelper')->setConstructorArgs(array($linkify))->getMock();

        $extension = new LinkifyTwigExtension($helper);

        $this->assertInstanceOf('Twig_Extension', $extension);
        $this->assertSame($helper, $this->readAttribute($extension, 'helper'));
    }

    public function testFilters()
    {
        $linkify = $this->getMockBuilder('Misd\Linkify\Linkify')->getMock();
        $helper = $this->getMockBuilder('Misd\LinkifyBundle\Helper\LinkifyHelper')->setConstructorArgs(array($linkify))->getMock();

        $extension = new LinkifyTwigExtension($helper);

        $filters = $extension->getFilters();

        $linkifyFilters = array_filter($filters, function (Twig_SimpleFilter $filter) {
            return $filter->getName() === 'linkify';
        });

        $this->assertCount(1, $linkifyFilters);
    }

    public function testLinkify()
    {
        $text = 'test';
        $options = array('key' => 'value');

        $linkify = $this->getMockBuilder('Misd\Linkify\Linkify')->getMock();
        $helper = $this->getMockBuilder('Misd\LinkifyBundle\Helper\LinkifyHelper')
            ->setMethods(array('process'))
            ->setConstructorArgs(array($linkify))
            ->getMock();
        $helper->expects($this->once())->method('process')->with($text, $options);

        $extension = new LinkifyTwigExtension($helper);

        $extension->linkify($text, $options);
    }

    public function testName()
    {
        $linkify = $this->getMockBuilder('Misd\Linkify\Linkify')->getMock();
        $helper = $this->getMockBuilder('Misd\LinkifyBundle\Helper\LinkifyHelper')->setConstructorArgs(array($linkify))->getMock();

        $extension = new LinkifyTwigExtension($helper);

        $this->assertTrue(is_string($extension->getName()));
    }
}
