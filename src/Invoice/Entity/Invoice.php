<?php

declare(strict_types=1);

namespace Flexpedia\Invoice\Entity;

use DateTimeInterface;
use Flexpedia\Invoice\Status\StatusInterface;
use Flexpedia\InvoiceItem\Entity\InvoiceItemInterface;

/**
 * Description of Invoice
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
final class Invoice implements InvoiceInterface
{
    /**
     * The invoice ID.
     *
     * @var int
     */
    private $id;

    /**
     * The client name.
     *
     * @var string
     */
    private $client;

    /**
     * The amount of invoice.
     *
     * @var float
     */
    private $amount;

    /**
     * The amount of invoice including VAT.
     *
     * @var float
     */
    private $amountWithVat;

    /**
     * The VAT rate of invoice.
     *
     * @var float
     */
    private $vatRate;

    /**
     * The status of invoice.
     *
     * @var StatusInterface
     */
    private $status;

    /**
     * The invoice date.
     *
     * @var DateTimeInterface
     */
    private $date;

    /**
     * The creation date of invoice.
     *
     * @var DateTimeInterface
     */
    private $createdAt;

    /**
     * The invoice items.
     *
     * @var array[InvoiceItemInterface]
     */
    private $items = [];

    public function __construct(
        int $id,
        string $client,
        float $amount,
        float $amountWithVat,
        float $vatRate,
        StatusInterface $status,
        DateTimeInterface $date,
        DateTimeInterface $createdAt,
        array $items = []
    ) {
        $this->id = $id;
        $this->client = $client;
        $this->amount = $amount;
        $this->amountWithVat = $amountWithVat;
        $this->vatRate = $vatRate;
        $this->status = $status;
        $this->date = $date;
        $this->createdAt = $createdAt;
        // TODO: Validate this property!
        $this->items = $items;
    }

    /**
     * @inheritDoc
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getClient() : string
    {
        return $this->client;
    }

    /**
     * @inheritDoc
     */
    public function getAmount() : float
    {
        return $this->amount;
    }

    /**
     * @inheritDoc
     */
    public function getAmountWithVat() : float
    {
        return $this->amountWithVat;
    }

    /**
     * @inheritDoc
     */
    public function getVatRate() : float
    {
        return $this->vatRate;
    }

    /**
     * @inheritDoc
     */
    public function getStatus() : StatusInterface
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    public function getDate() : DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt() : DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @inheritDoc
     */
    public function getItems() : array
    {
        return $this->items;
    }
}
