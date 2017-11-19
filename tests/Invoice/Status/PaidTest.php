<?php

namespace Flexpedia\Test\Invoice\Status;

use PHPUnit\Framework\TestCase;
use Flexpedia\Invoice\Status\Paid;
use Flexpedia\Invoice\Status\AbstractStatus;
use Flexpedia\Invoice\Status\StatusInterface;

/**
 * Description of PaidTest
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
class PaidTest extends TestCase
{
    /**
     * @var Paid
     */
    private $paid;

    protected function setUp()
    {
        $this->paid = new Paid;
    }

    public function testIsProperInstance()
    {
        $this->assertInstanceOf(AbstractStatus::class, $this->paid);
        $this->assertInstanceOf(StatusInterface::class, $this->paid);
    }

    public function testGetNameReturnsTheProperName()
    {
        $this->assertEquals(Paid::NAME, $this->paid->getName());
    }

    public function testOnStringConversionReturnsTheProperName()
    {
        $this->assertEquals(Paid::NAME, (string)$this->paid);
    }
}
