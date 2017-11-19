<?php

namespace Flexpedia\Test\Invoice\Repository;

use DateTime;
use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;
use Mockery;
use Flexpedia\Invoice\Entity\InvoiceInterface;
use Flexpedia\Invoice\Repository\InvoiceRepository;
use Flexpedia\InvoiceItem\Entity\InvoiceItem;
use Flexpedia\InvoiceItem\Repository\InvoiceItemRepository;

/**
 * Description of InvoiceRepositoryTest
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
class InvoiceRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $data = [
            [
                'id' => '1',
                'client' => 'Client 1',
                'invoice_amount' => '1.0',
                'invoice_amount_plus_vat' => '1.2',
                'vat_rate' => '0.2',
                'invoice_status' => 'paid',
                'invoice_date' => '2017-11-19',
                'created_at' => '2017-11-19 11:11:11'
            ],
            [
                'id' => '2',
                'client' => 'Client 2',
                'invoice_amount' => '2.0',
                'invoice_amount_plus_vat' => '2.2',
                'vat_rate' => '0.2',
                'invoice_status' => 'unpaid',
                'invoice_date' => '2017-11-19',
                'created_at' => '2017-11-19 22:22:22'
            ]
        ];

        $invoiceItems = [
            new InvoiceItem(1, 'Item', 2.0, DateTime::createFromFormat('Y-m-d H:i:s', '2017-11-19 11:11:11'))
        ];

        $pdoStatement = Mockery::mock(PDOStatement::class);
        $pdoStatement->shouldReceive('execute')->once()->andReturn(null);
        $pdoStatement->shouldReceive('fetchAll')->once()->andReturn($data);

        $pdo = Mockery::mock(PDO::class);
        $pdo->shouldReceive('prepare')->once()->with('SELECT * FROM invoices')->andReturn($pdoStatement);

        $invoiceItemRepository = Mockery::mock(InvoiceItemRepository::class);
        $invoiceItemRepository->shouldReceive('findByInvoice')->twice()->andReturn($invoiceItems);

        $invoices = (new InvoiceRepository($pdo, $invoiceItemRepository))->findAll();

        $this->assertTrue(is_array($invoices));
        $this->assertCount(2, $invoices);

        foreach ($data as $index => $item) {
            $invoice = $invoices[$index];

            $this->assertInstanceOf(InvoiceInterface::class, $invoice);
            $this->assertEquals((int)$item['id'], $invoice->getId());
            $this->assertEquals($item['client'], $invoice->getClient());
            $this->assertEquals((float)$item['invoice_amount'], $invoice->getAmount());
            $this->assertEquals((float)$item['invoice_amount_plus_vat'], $invoice->getAmountWithVat());
            $this->assertEquals((float)$item['vat_rate'], $invoice->getVatRate());
            $this->assertEquals($item['invoice_status'], (string)$invoice->getStatus());
            $this->assertEquals($item['invoice_date'], $invoice->getDate()->format('Y-m-d'));
            $this->assertEquals($item['created_at'], $invoice->getCreatedAt()->format('Y-m-d H:i:s'));

            $invoiceItems = $invoice->getItems();

            $this->assertTrue(is_array($invoiceItems));
            $this->assertCount(1, $invoiceItems);

            $this->assertEquals(1, $invoiceItems[0]->getId());
            $this->assertEquals('Item', $invoiceItems[0]->getName());
            $this->assertEquals(2.0, $invoiceItems[0]->getAmount());
            $this->assertEquals('2017-11-19 11:11:11', $invoiceItems[0]->getCreatedAt()->format('Y-m-d H:i:s'));
        }

        Mockery::close();
    }
}
