<?php

namespace Flexpedia\Test\InvoiceItem\Repository;

use DateTime;
use PDO;
use PDOStatement;
use Mockery;
use PHPUnit\Framework\TestCase;
use Flexpedia\Invoice\Entity\Invoice;
use Flexpedia\Invoice\Status\Paid;
use Flexpedia\InvoiceItem\Entity\InvoiceItem;
use Flexpedia\InvoiceItem\Entity\InvoiceItemInterface;
use Flexpedia\InvoiceItem\Repository\InvoiceItemRepository;

/**
 * Description of InvoiceItemRepositoryTest
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
class InvoiceItemRepositoryTest extends TestCase
{
    public function testFindByInvoice()
    {
        $invoice = new Invoice(1, 'Customer', 1.0, 1.0, 1.0, new Paid, new DateTime, new DateTime);

        $data = [
            [
                'id' => '1',
                'name' => 'Item 1',
                'amount' => '1.0',
                'created_at' => '2017-11-09 11:11:11'
            ],
            [
                'id' => '2',
                'name' => 'Item 2',
                'amount' => '2.0',
                'created_at' => '2017-11-09 22:22:22'
            ],
        ];

        $pdoStatement = Mockery::mock(PDOStatement::class);
        $pdoStatement->shouldReceive('execute')->once()->andReturn(null);
        $pdoStatement->shouldReceive('fetchAll')->once()->andReturn($data);

        $pdo = Mockery::mock(PDO::class);
        $pdo->shouldReceive('prepare')
            ->once()
            ->with('SELECT * FROM invoice_items WHERE invoice_id = ?')
            ->andReturn($pdoStatement);

        $invoiceItems = (new InvoiceItemRepository($pdo))->findByInvoice($invoice);

        $this->assertTrue(is_array($invoiceItems));
        $this->assertCount(2, $invoiceItems);

        foreach ($data as $index => $item) {
            $invoiceItem = $invoiceItems[$index];

            $this->assertInstanceOf(InvoiceItemInterface::class, $invoiceItem);
            $this->assertEquals((int)$item['id'], $invoiceItem->getId());
            $this->assertEquals($item['name'], $invoiceItem->getName());
            $this->assertEquals((float)$item['amount'], $invoiceItem->getAmount());
            $this->assertEquals($item['created_at'], $invoiceItem->getCreatedAt()->format('Y-m-d H:i:s'));
        }

        Mockery::close();
    }
}
