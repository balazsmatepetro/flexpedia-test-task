<?php

namespace Flexpedia\Test\Invoice\Entity;

use DateTime;
use PHPUnit\Framework\TestCase;
use Flexpedia\Invoice\Entity\Invoice;
use Flexpedia\Invoice\Status\Paid;
use Flexpedia\Invoice\Status\Unpaid;

/**
 * Description of InvoiceTest
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
class InvoiceTest extends TestCase
{
    const DATA_ID = 1;

    const DATA_CLIENT = 'Client';

    const DATA_AMOUNT = 1.0;

    const DATA_AMOUNT_WITH_VAT = 1.2;

    const DATA_VAT_RATE = 0.2;

    const DATA_DATE = '2017-11-19';

    const DATA_CREATED_AT = '2017-11-19 10:10:10';

    private $invoice;

    protected function setUp()
    {
        $this->invoice = new Invoice(
            self::DATA_ID,
            self::DATA_CLIENT,
            self::DATA_AMOUNT,
            self::DATA_AMOUNT_WITH_VAT,
            self::DATA_VAT_RATE,
            new Paid,
            DateTime::createFromFormat('Y-m-d', self::DATA_DATE),
            DateTime::createFromFormat('Y-m-d H:i:s', self::DATA_CREATED_AT)
        );
    }

    public function testGetId()
    {
        $this->assertEquals(self::DATA_ID, $this->invoice->getId());
    }

    public function testGetClient()
    {
        $this->assertEquals(self::DATA_CLIENT, $this->invoice->getClient());
    }

    public function testGetAmount()
    {
        $this->assertEquals(self::DATA_AMOUNT, $this->invoice->getAmount());
    }

    public function testGetAmountWithVat()
    {
        $this->assertEquals(self::DATA_AMOUNT_WITH_VAT, $this->invoice->getAmountWithVat());
    }

    public function testGetVatRate()
    {
        $this->assertEquals(self::DATA_VAT_RATE, $this->invoice->getVatRate());
    }

    public function testGetStatus()
    {
        $this->assertEquals(Paid::NAME, (string)$this->invoice->getStatus());
    }

    public function testGetDate()
    {
        $this->assertEquals(self::DATA_DATE, $this->invoice->getDate()->format('Y-m-d'));
    }

    public function testGetCreatedAt()
    {
        $this->assertEquals(self::DATA_CREATED_AT, $this->invoice->getCreatedAt()->format('Y-m-d H:i:s'));
    }

    public function testIsPaid()
    {
        $this->assertTrue($this->invoice->isPaid());

        $invoice = new Invoice(
            self::DATA_ID,
            self::DATA_CLIENT,
            self::DATA_AMOUNT,
            self::DATA_AMOUNT_WITH_VAT,
            self::DATA_VAT_RATE,
            new Unpaid,
            DateTime::createFromFormat('Y-m-d', self::DATA_DATE),
            DateTime::createFromFormat('Y-m-d H:i:s', self::DATA_CREATED_AT)
        );

        $this->assertFalse($invoice->isPaid());
    }
}
