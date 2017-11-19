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
    private $Unpaid;

    protected function setUp()
    {
        $this->Unpaid = new Unpaid;
    }

    public function testIsProperInstance()
    {
        $this->assertInstanceOf(AbstractStatus::class, $this->Unpaid);
        $this->assertInstanceOf(StatusInterface::class, $this->Unpaid);
    }

    public function testGetNameReturnsTheProperName()
    {
        $this->assertEquals(Unpaid::NAME, $this->Unpaid->getName());
    }

    public function testOnStringConversionReturnsTheProperName()
    {
        $this->assertEquals(Unpaid::NAME, (string)$this->Unpaid);
    }
}
