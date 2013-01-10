<?php

namespace NewbridgeGreen\RulesBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use NewbridgeGreen\RulesBundle\Tests\Functional\App\AppTestKernel;

class FunctionalTestCase extends WebTestCase
{
    protected static $appDir;

    protected static $dm;

    protected static $rm;

    protected function setUp()
    {
        parent::setUp();

        static::$appDir = __DIR__.'/App';

        // Clear up old data
        $filesystem = new \Symfony\Component\Filesystem\Filesystem();
        $filesystem->remove(static::$appDir.'/cache');
        $filesystem->remove(static::$appDir.'/logs');
        $filesystem->mkdir(static::$appDir.'/cache');
        $filesystem->mkdir(static::$appDir.'/logs');

        // We're functional testing so we will be using the app for each test
        static::$kernel = static::createTestKernel();
        static::$dm->getConnection()->dropDatabase('rules_test');
    }

    protected static function createTestKernel(array $options = array())
    {

        static::$kernel = static::createKernel($options);
        static::$kernel->boot();

        static::$dm = static::$kernel->getContainer()->get('doctrine_mongodb.odm.document_manager');
        static::$rm = static::$kernel->getContainer()->get('newbridge_green_rules.rule_manager');

        //static::generateSchema();
        //static::loadFixtures();
    }

    protected static function getKernelClass()
    {
        require_once static::$appDir.'/AppTestKernel.php';

        return 'NewbridgeGreen\RulesBundle\Tests\Functional\App\AppTestKernel';
    }

    protected function getDocumentManager()
    {
        return static::$dm;
    }

    protected function getRuleManager()
    {
        return static::$rm;
    }

}
