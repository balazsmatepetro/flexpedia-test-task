<?php

declare(strict_types=1);

namespace Flexpedia\Invoice;

use Flexpedia\Invoice\Repository\InvoiceRepositoryInterface;

/**
 * Description of InvoiceList
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
final class InvoiceList
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
     * Renders the given page of invoices.
     *
     * @param int $page The page to render.
     * @return string
     */
    public function __invoke(int $page)
    {
        $pagination = new Pagination($this->invoice->findAll());

        $data = [
            'currentPage' => $page,
            'invoices' => $pagination->getPage($page),
            'numberOfPages' => count($pagination)
        ];

        extract($data);

        ob_start();
        require __DIR__ . '/../../templates/invoice-list.php';
        return ob_get_clean();
    }
}
