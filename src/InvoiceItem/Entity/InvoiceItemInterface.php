<?php

declare(strict_types=1);

namespace Flexpedia\InvoiceItem\Entity;

use DateTimeInterface;

/**
 * Description of InvoiceItemInterface
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
interface InvoiceItemInterface
{
    /**
     * Returns the invoice item ID.
     *
     * @return int
     */
    public function getId() : int;

    /**
     * Returns the name of invoice item.
     *
     * @return string
     */
    public function getName() : string;

    /**
     * Returns the amount of invoice item.
     *
     * @return float
     */
    public function getAmount() : float;

    /**
     * Returns the creation date of invoice item.
     *
     * @return DateTimeInterface
     */
    public function getCreatedAt() : DateTimeInterface;
}
