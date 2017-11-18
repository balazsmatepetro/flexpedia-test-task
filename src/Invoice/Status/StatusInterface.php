<?php

declare(strict_types=1);

namespace Flexpedia\Invoice\Status;

/**
 * Description of StatusInterface
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
interface StatusInterface
{
    /**
     * Returns the name of status.
     *
     * @return string
     */
    public function getName() : string;
}
