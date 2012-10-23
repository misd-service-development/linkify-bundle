<?php

/*
 * This file is part of the Symfony2 LinkifyBundle.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\LinkifyBundle\Twig\Extension;

use Twig_Extension, Twig_Filter_Method;
use Misd\LinkifyBundle\Helper\LinkifyHelper;

/**
 * LinkifyTwigExtension
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
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
            'linkify' => new Twig_Filter_Method($this, 'linkify', array(
                'pre_escape' => 'html',
                'is_safe' => array('html')
            )),
        );
    }

    /**
     * Linkify text.
     *
     * @param string $text Text to process.
     *
     * @return string Processed text.
     */
    public function linkify($text)
    {
        return $this->helper->process($text);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'linkify';
    }
}
