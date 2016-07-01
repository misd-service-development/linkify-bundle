LinkifyBundle
=============

[![Build Status](https://travis-ci.org/misd-service-development/linkify-bundle.svg?branch=master)](https://travis-ci.org/misd-service-development/linkify-bundle)

Adds [Linkify](https://github.com/misd-service-development/php-linkify) to your Symfony application, which converts URLs and email addresses in HTML (or plain text) to HTML links.

Installation
------------

 1. Add the LinkifyBundle to your dependencies:

        $ composer require misd/linkify-bundle

 2. Register the bundle in your application:

        // app/AppKernel.php

        class AppKernel extends Kernel
        {
            // ...
            public function registerBundles()
            {
                $bundles = array(
                    // ...
                    new Misd\LinkifyBundle\MisdLinkifyBundle(),
                    // ...
                );
            }
            // ...
        }

Usage
-----

Use the service:

    $text = $this->container->get('misd.linkify')->process('This is my text containing a link to www.example.com.');

In a Twig template:

    {{ "This is my text containing a link to www.example.com."|linkify }}

In a PHP template:

    <?php echo $view['linkify']->process('This is my text containing a link to www.example.com.') ?>

### Options

*Requires Linkify v1.1.1 or newer.*

An array of options can be passed (see the Linkify docs for futher details). So to add the `link` class to created links:

Using the service:

    $text = $this->container->get('misd.linkify')->process('This is my text containing a link to www.example.com.', array('attr' => array('class' => 'link')));

In a Twig template:

    {{ "This is my text containing a link to www.example.com."|linkify({'attr': {'class': 'link'}}) }}

In a PHP template:

    <?php echo $view['linkify']->process('This is my text containing a link to www.example.com.', array('attr' => array('class' => 'link'))) ?>
