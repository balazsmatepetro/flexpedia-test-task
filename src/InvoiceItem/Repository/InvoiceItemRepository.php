<?php

declare(strict_types=1);

namespace Flexpedia\InvoiceItem\Repository;

use DateTimeImmutable;
use PDO;
use Flexpedia\Invoice\Entity\InvoiceInterface;
use Flexpedia\InvoiceItem\Entity\InvoiceItem;
use Flexpedia\InvoiceItem\Entity\InvoiceItemInterface;

/**
 * Description of InvoiceItemRepository
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
class InvoiceItemRepository implements InvoiceItemRepositoryInterface
{
    /**
     * Creates a new InvoiceItemRepository instance.
     *
     * @param PDO $pdo The PDO instance.
     */
    public function __construct(PDO $pdo)
    {
        // NOTE: Not a good approach to stick to the PDO implementation, a StorageInterface
        // or something like that would be the best solution to communicate with the DB, but this
        // time I don't have enough time to write a framework... :)
        $this->pdo = $pdo;
    }

    /**
     * @inheritDoc
     */
    public function findByInvoice(InvoiceInterface $invoice) : array
    {
        $statement = $this->pdo->prepare('SELECT * FROM invoice_items WHERE invoice_id = ?');
        $statement->execute([$invoice->getId()]);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return array_map(function ($item) {
            return $this->mapInvoiceItem($item);
        }, $result);
    }

    /**
     * Maps the given invoice item data to a new InvoiceItem instance.
     *
     * @param array $data The invoice item data.
     * @return InvoiceItem
     */
    private function mapInvoiceItem($data)
    {
        return new InvoiceItem(
            (int)$data['id'],
            $data['name'],
            (float)$data['amount'],
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $data['created_at'])
        );
    }
}
