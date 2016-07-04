<?php

/*
 * This file is part of the Symfony LinkifyBundle.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\LinkifyBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFilter;
use Misd\LinkifyBundle\Helper\LinkifyHelper;

/**
 * LinkifyTwigExtension
 */
class LinkifyTwigExtension extends Twig_Extension
{
    /**
     * @var LinkifyHelper
     */
    protected $helper;

    /**
     * Constructor.
     *
     * @param LinkifyHelper $helper Linkify helper
     */
    public function __construct(LinkifyHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('linkify', array($this, 'linkify'), array(
                'pre_escape' => 'html',
                'is_safe'    => array('html')
            )),
        );
    }

    /**
     * Linkify text.
     *
     * @param string $text    Text to process.
     * @param array  $options Options.
     *
     * @return string Processed text.
     */
    public function linkify($text, array $options = array())
    {
        return $this->helper->process($text, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'linkify';
    }
}
