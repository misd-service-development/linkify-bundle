<?php

/*
 * This file is part of the Symfony2 LinkifyBundle.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\LinkifyBundleBundle\Tests\Helper;

use Misd\LinkifyBundle\Helper\LinkifyHelper;
use Misd\LinkifyBundle\Tests\AbstractTestCase;

class LinkifyHelperTest extends AbstractTestCase
{
    public function testConstructor()
    {
        $linkify = $this->getMock('Misd\Linkify\Linkify');

        $helper = new LinkifyHelper($linkify);

        $this->assertInstanceOf('Symfony\Component\Templating\Helper\HelperInterface', $helper);
        $this->assertSame($linkify, $this->readAttribute($helper, 'linkify'));
    }

    public function testCharset()
    {
        $linkify = $this->getMock('Misd\Linkify\Linkify');

        $helper = new LinkifyHelper($linkify);

        $helper->setCharset('test');

        $this->assertSame('test', $helper->getCharset());
    }

    public function testName()
    {
        $linkify = $this->getMock('Misd\Linkify\Linkify');

        $helper = new LinkifyHelper($linkify);

        $this->assertTrue(is_string($helper->getName()));
    }

    public function testProcess()
    {
        $text = 'test';
        $options = array('key' => 'value');

        $linkify = $this->getMock('Misd\Linkify\Linkify');
        $linkify->expects($this->once())->method('process')->with($text, $options);

        $helper = new LinkifyHelper($linkify);

        $helper->process($text, $options);
    }
}
