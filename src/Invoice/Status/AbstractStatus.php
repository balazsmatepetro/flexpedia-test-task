<?php

declare(strict_types=1);

namespace Flexpedia\Invoice\Status;

/**
 * Description of AbstractStatus
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
abstract class AbstractStatus implements StatusInterface
{
    public function __toString()
    {
        return $this->getName();
    }
}
