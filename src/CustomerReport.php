<?php

declare(strict_types=1);

namespace Flexpedia;

use Flexpedia\CsvOutput;
use Flexpedia\Invoice\Repository\InvoiceRepositoryInterface;

/**
 * Description of CustomerReport
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
final class CustomerReport
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
     * Creates a new CustomerReport instance.
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
     * Creates and returns the CSV output of company report.
     *
     * @return string
     */
    public function __invoke()
    {
        $invoices = $this->invoice->findAll();
        $clientMap = [];
        $data = [];

        foreach ($invoices as $invoice) {
            $client = $invoice->getClient();
            $amount = $invoice->getAmount();
            $isPaid = $invoice->isPaid();
            $mapIndex = array_search($client, $clientMap, true);

            if (false === $mapIndex) {
                $clientMap[] = $client;
                $data[] = ['name' => $client, 'total' => 0, 'paid' => 0, 'outstanding' => 0];
                end($data);
                $mapIndex = key($data);
            }

            $data[$mapIndex]['total'] += $amount;
            $data[$mapIndex]['paid'] += $isPaid ? $amount : 0;
            $data[$mapIndex]['outstanding'] += $isPaid ? 0 : $amount;
        }

        return $this->csvOutput->render($data);
    }
}
