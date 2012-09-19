LinkifyBundle
=============

Adds [Linkify](https://github.com/misd-service-development/php-linkify) to your Symfony2 application, which converts URLs and email addresses into HTML links.

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
               "misd/linkify-bundle": "dev-master"
           }
        }

 2. Use Composer to download and install LinkifyBundle:

        $ php composer.phar update misd/linkify-bundle

Usage
-----

Use the service:

        $text = $this->container->get('misd.linkify')->process('This is my text containing a link to www.example.com.');

In a Twig template:

        {{ "This is my text containing a link to www.example.com."|linkify }}

In a PHP template:

        <?php echo $view['linkify']->process('This is my text containing a link to www.example.com.') ?>