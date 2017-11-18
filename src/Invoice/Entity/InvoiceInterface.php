<?php

declare(strict_types=1);

namespace Flexpedia\Invoice\Entity;

use DateTimeInterface;
use Flexpedia\Invoice\Status\StatusInterface;
use Flexpedia\InvoiceItem\Entity\InvoiceItemInterface;

/**
 * Description of InvoiceInterface
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
interface InvoiceInterface
{
    /**
     * Returns the invoice ID.
     *
     * @return int
     */
    public function getId() : int;

    /**
     * Returns the client name.
     *
     * @return string
     */
    public function getClient() : string;

    /**
     * Returns the amount of invoice.
     *
     * @return float
     */
    public function getAmount() : float;

    /**
     * Returns the amount of invoice including VAT.
     *
     * @return float
     */
    public function getAmountWithVat() : float;

    /**
     * Returns the VAT rate of invoice.
     *
     * @return float
     */
    public function getVatRate() : float;

    /**
     * Returns the status of invoice.
     *
     * @return StatusInterface
     */
    public function getStatus() : StatusInterface;

    /**
     * Returns the invoice date.
     *
     * @return DateTimeInterface
     */
    public function getDate() : DateTimeInterface;

    /**
     * Returns the creation date of Invoice.
     *
     * @return DateTimeInterface
     */
    public function getCreatedAt() : DateTimeInterface;

    /**
     * Returns the invoice items.
     *
     * @return array[InvoiceItemInterface]
     */
    public function getItems() : array;
}
