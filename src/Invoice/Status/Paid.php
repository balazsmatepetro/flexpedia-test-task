<?php

declare(strict_types=1);

namespace Flexpedia\Invoice\Status;

/**
 * Description of Paid
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
final class Paid extends AbstractStatus
{
    const NAME = 'paid';

    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return self::name;
    }
}
