<?php
/**
 * Newbridge Green
 * User: jsutherland
 */
namespace NewbridgeGreen\RulesBundle\Tests\Comparator;

use NewbridgeGreen\RulesBundle\Comparator\Contains;

class ContainsTest extends \PHPUnit_Framework_TestCase
{
    public function testContainssComparison()
    {
        $contains = new Contains('/Newbridge Green/invoices');
        $this->assertTrue($contains->compare('/Newbridge Green/invoices/github-invoice.pdf'));
        $this->assertFalse($contains->compare('/invoices'));
    }

}
