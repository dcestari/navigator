<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'          => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    'Doctrine\\Common' => __DIR__.'/../vendor/symfony/vendor/doctrine-common/lib',
    'Doctrine\\DBAL'   => __DIR__.'/../vendor/symfony/vendor/doctrine-dbal/lib',
    'Doctrine'         => __DIR__.'/../vendor/symfony/vendor/doctrine/lib',
    'Monolog'          => __DIR__.'/../vendor/symfony/vendor/monolog/src',
    'Assetic'          => __DIR__.'/../vendor/symfony/vendor/assetic/src',
    'Metadata'         => __DIR__.'/../vendor/symfony/vendor/metadata/src',
));
$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../vendor/symfony/vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../vendor/symfony/vendor/twig/lib',
));
$loader->registerPrefixFallbacks(array(
    __DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs',
));
$loader->registerNamespaceFallbacks(array(
    __DIR__.'/../src',
));
$loader->register();

// Swiftmailer needs a special autoloader to allow
// the lazy loading of the init file (which is expensive)
require_once __DIR__.'/../vendor/symfony/vendor/swiftmailer/lib/classes/Swift.php';
Swift::registerAutoload(__DIR__.'/../vendor/symfony/vendor/swiftmailer/lib/swift_init.php');
