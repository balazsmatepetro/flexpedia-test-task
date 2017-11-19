<?php

declare(strict_types=1);

namespace Flexpedia\InvoiceItem\Entity;

use DateTimeInterface;

/**
 * Description of InvoiceItem
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
final class InvoiceItem implements InvoiceItemInterface
{
    /**
     * The invoice item ID.
     *
     * @var int
     */
    private $id;

    /**
     * The name of invoice item.
     *
     * @var string
     */
    private $name;

    /**
     * The amount of invoice item.
     *
     * @var float
     */
    private $amount;

    /**
     * The creation date of invoice item.
     *
     * @var DateTimeInterface
     */
    private $createdAt;

    /**
     * Creates a new InvoiceItem instance.
     *
     * @param int $id The ID of invoice item.
     * @param string $name The name of invoice item.
     * @param float $amount The amount of invoice item.
     * @param DateTimeInterface $createdAt The creation date of invoice item.
     */
    public function __construct(int $id, string $name, float $amount, DateTimeInterface $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
        $this->createdAt = $createdAt;
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
    public function getName() : string
    {
        return $this->name;
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
    public function getCreatedAt() : DateTimeInterface
    {
        return $this->createdAt;
    }
}
