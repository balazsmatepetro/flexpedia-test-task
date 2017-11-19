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
     * The CSV renderer.
     *
     * @var CsvOutput
     */
    private $csvOutput;
    
    /**
     * Creates a new InvoiceList instance.
     *
     * @param InvoiceRepositoryInterface $invoice The invoice repository instance.
     * @param CsvOutput $csvOutput The CsvOutput instance.
     */
    public function __construct(InvoiceRepositoryInterface $invoice, CsvOutput $csvOutput)
    {
        $this->invoice = $invoice;
        $this->csvOutput = $csvOutput;
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

        return $this->csvOutput->render($data);
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
