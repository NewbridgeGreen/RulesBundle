<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
//use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

$file = __DIR__.'/../vendor/autoload.php';
if (!file_exists($file)) {
    throw new RuntimeException('Install dependencies to run test suite. "php composer.phar install --dev"');
}

$loader = require_once $file;

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

AnnotationRegistry::registerFile(
    __DIR__.'/../vendor/doctrine/mongodb-odm/lib/Doctrine/ODM/MongoDB/Mapping/Annotations/DoctrineAnnotations.php'
);