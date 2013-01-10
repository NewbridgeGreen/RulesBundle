<?php
/**
 * Newbridge Green
 * User: jsutherland
 */

namespace NewbridgeGreen\RulesBundle\Tests\Command;

use NewbridgeGreen\RulesBundle\Command\InitRulesMongoDBCommand;

class InitRulesMongoDBCommandTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->command = new InitRulesMongoDBCommand();
    }

    public function testCommand()
    {
        $this->assertTrue($this->command->isEnabled());
    }
}