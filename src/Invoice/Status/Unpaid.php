<?php

declare(strict_types=1);

namespace Flexpedia\Invoice\Status;

/**
 * Description of Unpaid
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
final class Unpaid extends AbstractStatus
{
    const NAME = 'unpaid';

    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return self::NAME;
    }
}
