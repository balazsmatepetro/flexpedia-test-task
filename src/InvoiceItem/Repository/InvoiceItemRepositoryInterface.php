<?php

declare(strict_types=1);

namespace Flexpedia\InvoiceItem\Repository;

use DateTimeInterface;
use Flexpedia\Invoice\Entity\InvoiceInterface;
use Flexpedia\InvoiceItem\Entity\InvoiceItemInterface;

/**
 * Description of InvoiceItemRepositoryInterface
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
interface InvoiceItemRepositoryInterface
{
    /**
     * Finds and returns all invoice items by the given invoice.
     *
     * @param InvoiceInterface $invoice The invoice.
     * @return array[InvoiceItemInterface]
     */
    public function findByInvoice(InvoiceInterface $invoice) : array;
}
