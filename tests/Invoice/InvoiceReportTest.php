<?php

namespace Flexpedia\Test\Invoice;

use DateTime;
use PHPUnit\Framework\TestCase;
use Mockery;
use Flexpedia\Invoice\InvoiceReport;
use Flexpedia\Invoice\Entity\Invoice;
use Flexpedia\Invoice\Repository\InvoiceRepositoryInterface;
use Flexpedia\Invoice\Status\Paid;

/**
 * Description of InvoiceReportTest
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
class InvoiceReportTest extends TestCase
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
            )
        ]);

        $output = (new InvoiceReport($repository))->__invoke();

        $lines = explode("\n", $output);

        $this->assertEquals('1,"Client 1",1', $lines[0]);
        $this->assertEquals('2,"Client 2",2', $lines[1]);

        Mockery::close();
    }
}
