<?php

declare(strict_types=1);

namespace Flexpedia\Invoice\Repository;

use DateTimeImmutable;
use PDO;
use Flexpedia\Invoice\Entity\Invoice;
use Flexpedia\Invoice\Status\Paid;
use Flexpedia\Invoice\Status\Unpaid;
use Flexpedia\InvoiceItem\Entity\InvoiceItemInterface;
use Flexpedia\InvoiceItem\Repository\InvoiceItemRepositoryInterface;

/**
 * Description of InvoiceRepository
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
final class InvoiceRepository implements InvoiceRepositoryInterface
{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    private $pdo;

    /**
     * The invoice item repository instance.
     *
     * @var InvoiceItemRepositoryInterface
     */
    private $itemRepository;

    /**
     * Creates a new InvoiceRepository instance.
     *
     * @param PDO $pdo The PDO instance.
     * @param InvoiceItemRepositoryInterface $itemRepository The invoice item repository instance.
     */
    public function __construct(PDO $pdo, InvoiceItemRepositoryInterface $itemRepository)
    {
        // NOTE: Not a good approach to stick to the PDO implementation, a StorageInterface
        // or something like that would be the best solution to communicate with the DB, but this
        // time I don't have enough time to write a framework... :)
        $this->pdo = $pdo;
        $this->itemRepository = $itemRepository;
    }

    /**
     * @inheritDoc
     */
    public function findAll() : array
    {
        $statement = $this->pdo->prepare('SELECT * FROM invoices');
        $statement->execute();
        
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $invoices = [];

        foreach ($result as $item) {
            $invoice = $this->mapInvoice($item, []);
            // We need this because of the immutability.
            $invoices[] = $this->mapInvoice($item, $this->itemRepository->findByInvoice($invoice));

            unset($invoice);
        }

        unset($result);

        return $invoices;
    }

    /**
     * Maps the given invoice data to a new Invoice instance.
     *
     * @param array $data The invoice data.
     * @param array[InvoiceItemInterface] $items The InvoiceItem collection.
     * @return Invoice
     */
    private function mapInvoice($data, array $items)
    {
        return new Invoice(
            (int)$data['id'],
            $data['client'],
            (float)$data['invoice_amount'],
            (float)$data['invoice_amount_plus_vat'],
            (float)$data['vat_rate'],
            $data['invoice_status'] === Paid::NAME ? new Paid : new Unpaid,
            DateTimeImmutable::createFromFormat('Y-m-d', $data['invoice_date']),
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $data['created_at']),
            $items
        );
    }
}
