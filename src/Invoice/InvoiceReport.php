<?php

declare(strict_types=1);

namespace Flexpedia\Invoice;

use Flexpedia\CsvOutput;
use Flexpedia\Invoice\Entity\InvoiceInterface;
use Flexpedia\Invoice\Repository\InvoiceRepositoryInterface;

/**
 * Description of InvoiceReport
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
final class InvoiceReport
{
    /**
     * The invoice repository.
     *
     * @var InvoiceRepositoryInterface
     */
    private $invoice;
    
    /**
     * Creates a new InvoiceList instance.
     *
     * @param InvoiceRepositoryInterface $invoice The invoice repository instance.
     */
    public function __construct(InvoiceRepositoryInterface $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Creates and returns the CSV output of invoices.
     *
     * @return string
     */
    public function __invoke()
    {
        $data = array_map(function ($invoice) {
            return $this->mapInvoice($invoice);
        }, $this->invoice->findAll());

        // NOTE: Applying a writer interface wouldn't violate the SOLID principles!
        return CsvOutput::render($data);
    }

    /**
     * Maps and returns the given Invoice instance to an array.
     *
     * @param InvoiceInterface $invoice The Invoice instance.
     * @return array
     */
    private function mapInvoice(InvoiceInterface $invoice)
    {
        return [
            $invoice->getId(),
            $invoice->getClient(),
            $invoice->getAmount()
        ];
    }
}
