<?php

declare(strict_types=1);

namespace Flexpedia\Invoice\Repository;

/**
 * Description of InvoiceRepositoryInterface
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
interface InvoiceRepositoryInterface
{
    public function findAll() : array;
}
