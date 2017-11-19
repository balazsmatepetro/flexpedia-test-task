<?php

namespace Flexpedia\Test\Invoice;

use Countable;
use DateTime;
use InvalidArgumentException;
use OutOfRangeException;
use stdClass;
use PHPUnit\Framework\TestCase;
use Flexpedia\Invoice\Pagination;
use Flexpedia\Invoice\Entity\Invoice;
use Flexpedia\Invoice\Entity\InvoiceInterface;
use Flexpedia\Invoice\Status\Paid;

/**
 * Description of PaginationTest
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
class PaginationTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The given collection cannot be empty!
     */
    public function testConstructThrowsExceptionWhenInvoicesArgumentIsAnEmptyArray()
    {
        new Pagination([]);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage All items must be an instance of 
     */
    public function testConstructThrowsExceptionWhenOneOfTheInvoicesIsNotAnObject()
    {
        new Pagination([1]);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage All items must be an instance of 
     */
    public function testConstructThrowsExceptionWhenOneOfTheInvoicesIsNotProperInstance()
    {
        new Pagination([new stdClass]);        
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The size must be greater than zero!
     */
    public function testConstructThrowsExceptionWhenSizeArgumentIsInvalid()
    {
        new Pagination($this->generateInvoices(), 0);
    }

    public function testGetPageReturnsTheProperAmountOfInvoices()
    {
        $pagination = new Pagination($this->generateInvoices(), 4);

        $this->assertCount(4, $pagination->getPage(1));
    }

    /**
     * @expectedException OutOfRangeException
     * @expectedExceptionMessage The given page doesn't exist!
     */
    public function testGetPageThrowsExceptionWhenTheGivenPageDoesNotExist()
    {
        $pagination = new Pagination($this->generateInvoices());

        $pagination->getPage(100);
    }

    public function testGetPageReturnsCollectionOfInvoiceInterface()
    {
        $pagination = new Pagination($this->generateInvoices(), 2);

        $page = $pagination->getPage(1);

        $this->assertCount(2, $page);
        $this->assertTrue(is_array($page));

        $this->assertInstanceOf(InvoiceInterface::class, $page[0]);
        $this->assertInstanceOf(InvoiceInterface::class, $page[1]);
    }

    public function testGetPageReturnsProperCollection()
    {
        $pagination = new Pagination($this->generateInvoices(), 2);
        
        $page = $pagination->getPage(2);

        $this->assertEquals(3, $page[0]->getId());
        $this->assertEquals(4, $page[1]->getId());
    }

    public function testProperlyCountable()
    {
        $pagination = new Pagination($this->generateInvoices());

        $this->assertInstanceOf(Countable::class, $pagination);
        $this->assertCount(2, $pagination);
    }

    private function generateInvoices()
    {
        $invoices = [];

        for ($i = 1; $i < 11; $i++) {
            $invoices[] = new Invoice(
                $i,
                'Customer-' . $i,
                0.0 + $i,
                0.0 + $i,
                0.0 + $i,
                new Paid,
                new DateTime,
                new DateTime
            );
        }

        return $invoices;
    }
}
