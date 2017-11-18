<?php

declare(strict_types=1);

namespace Flexpedia\Invoice;

use Countable;
use InvalidArgumentException;
use OutOfRangeException;
use Flexpedia\Invoice\Entity\InvoiceInterface;

/**
 * Description of Paid
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
final class Pagination implements Countable
{
    /**
     * The default size of page.
     */
    const DEFAULT_SIZE = 5;

    /**
     * The InvoiceInterface collections.
     *
     * @var array
     */
    private $pages;

    /**
     * Creates a new Pagination instance.
     *
     * @param array[InvoiceInterface] $invoices The invoice collection.
     * @param int $size The page size.
     * @throws InvalidArgumentException Thrown when one of the arguments is invalid.
     */
    public function __construct(array $invoices, int $size = self::DEFAULT_SIZE)
    {
        if (0 >= $size) {
            throw new InvalidArgumentException('The size must be greater than zero!');
        }
        
        if (empty($invoices)) {
            throw new InvalidArgumentException('The given collection cannot be empty!');
        }

        foreach ($invoices as $invoice) {
            if (!is_object($invoice) || !($invoice instanceof InvoiceInterface)) {
                throw new InvalidArgumentException('All items must be an instance of ' . InvoiceInterface::class);
            }
        }

        $this->pages = array_chunk($invoices, $size);
    }

    /**
     * Returns the requested page.
     *
     * @param int $page The page index.
     * @return array[InvoiceInterface]
     * @throws OutOfRangeException Thrown when the given index doesn't exist.
     */
    public function getPage(int $page) : array
    {
        $page--;
        
        if (!array_key_exists($page, $this->pages)) {
            throw new OutOfRangeException('The given page doesn\'t exist!');
        }

        return $this->pages[$page];
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->pages);
    }
}
