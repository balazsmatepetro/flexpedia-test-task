<?php

namespace Flexpedia\Test\Invoice\Status;

use PHPUnit\Framework\TestCase;
use Flexpedia\Invoice\Status\Unpaid;
use Flexpedia\Invoice\Status\AbstractStatus;
use Flexpedia\Invoice\Status\StatusInterface;

/**
 * Description of UnpaidTest
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
class UnpaidTest extends TestCase
{
    /**
     * @var Unpaid
     */
    private $unpaid;

    protected function setUp()
    {
        $this->unpaid = new Unpaid;
    }

    public function testIsProperInstance()
    {
        $this->assertInstanceOf(AbstractStatus::class, $this->unpaid);
        $this->assertInstanceOf(StatusInterface::class, $this->unpaid);
    }

    public function testGetNameReturnsTheProperName()
    {
        $this->assertEquals(Unpaid::NAME, $this->unpaid->getName());
    }

    public function testOnStringConversionReturnsTheProperName()
    {
        $this->assertEquals(Unpaid::NAME, (string)$this->unpaid);
    }
}
