LinkifyBundle
=============

[![Build Status](https://travis-ci.org/misd-service-development/linkify-bundle.png?branch=master)](https://travis-ci.org/misd-service-development/linkify-bundle)

Adds [Linkify](https://github.com/misd-service-development/php-linkify) to your Symfony2 application, which converts URLs and email addresses in HTML (or plain text) to HTML links.

Authors
-------

* Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>

Installation
------------

 1. Add LinkifyBundle to your dependencies:

        // composer.json

        {
           // ...
           "require": {
               // ...
               "misd/linkify-bundle": "~1.0"
           }
        }

 2. Use Composer to download and install LinkifyBundle:

        $ php composer.phar update misd/linkify-bundle

 3. Register the bundle in your application:

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
