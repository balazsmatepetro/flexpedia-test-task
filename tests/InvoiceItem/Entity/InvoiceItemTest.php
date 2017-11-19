<?php

namespace Flexpedia\Test\InvoiceItem\Entity;

use DateTimeInterface;
use DateTime;
use PHPUnit\Framework\TestCase;
use Flexpedia\InvoiceItem\Entity\InvoiceItem;

/**
 * Description of InvoiceItemTest
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
class InvoiceItemTest extends TestCase
{
    const DATA_ID = 1;

    const DATA_NAME = 'Name';

    const DATA_AMOUNT = 1.0;

    const DATA_CREATED_AT = '2017-11-19 11:11:11';

    private $invoiceItem;

    protected function setUp()
    {
        $this->invoiceItem = new InvoiceItem(
            self::DATA_ID,
            self::DATA_NAME,
            self::DATA_AMOUNT,
            DateTime::createFromFormat('Y-m-d H:i:s', self::DATA_CREATED_AT)
        );
    }

    public function testGetIdReturnsTheGivenValue()
    {
        $this->assertEquals(self::DATA_ID, $this->invoiceItem->getId());
    }

    public function testGetNameReturnsTheGivenValue()
    {
        $this->assertEquals(self::DATA_NAME, $this->invoiceItem->getName());
    }

    public function testGetAmountReturnsTheGivenValue()
    {
        $this->assertEquals(self::DATA_AMOUNT, $this->invoiceItem->getAmount());
    }

    public function testGetCreatedAtReturnsTheGivenValues()
    {
        $this->assertEquals(self::DATA_CREATED_AT, $this->invoiceItem->getCreatedAt()->format('Y-m-d H:i:s'));
    }
}
