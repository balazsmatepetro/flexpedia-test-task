<?php

namespace Flexpedia\Test;

use DateTime;
use Mockery;
use PHPUnit\Framework\TestCase;
use Flexpedia\CustomerReport;
use Flexpedia\Invoice\Entity\Invoice;
use Flexpedia\Invoice\Repository\InvoiceRepositoryInterface;
use Flexpedia\Invoice\Status\Paid;
use Flexpedia\Invoice\Status\Unpaid;

/**
 * Description of CustomerReportTest
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
class CustomerReportTest extends TestCase
{
    public function testInvoke()
    {
        $repository = Mockery::mock(InvoiceRepositoryInterface::class);
        $repository->shouldReceive('findAll')->once()->andReturn([
            new Invoice(
                1,
                'Client 1',
                1.0,
                1.2,
                0.2,
                new Paid,
                DateTime::createFromFormat('Y-m-d', '2017-11-19'),
                DateTime::createFromFormat('Y-m-d H:i:s', '2017-11-19 10:10:10'),
                []
            ),
            new Invoice(
                2,
                'Client 2',
                2.0,
                2.2,
                0.2,
                new Paid,
                DateTime::createFromFormat('Y-m-d', '2017-11-19'),
                DateTime::createFromFormat('Y-m-d H:i:s', '2017-11-19 11:11:11'),
                []
            ),
            new Invoice(
                3,
                'Client 3',
                1.0,
                1.2,
                0.2,
                new Unpaid,
                DateTime::createFromFormat('Y-m-d', '2017-11-19'),
                DateTime::createFromFormat('Y-m-d H:i:s', '2017-11-19 12:12:12'),
                []
            ),
            new Invoice(
                3,
                'Client 2',
                2.0,
                2.2,
                0.2,
                new Unpaid,
                DateTime::createFromFormat('Y-m-d', '2017-11-19'),
                DateTime::createFromFormat('Y-m-d H:i:s', '2017-11-19 13:13:13'),
                []
            )
        ]);

        $output = (new CustomerReport($repository))->__invoke();

        $lines = explode("\n", $output);

        $this->assertEquals('"Client 1",1,1,0', $lines[0]);
        $this->assertEquals('"Client 2",4,2,2', $lines[1]);
        $this->assertEquals('"Client 3",1,0,1', $lines[2]);

        Mockery::close();
    }
}
