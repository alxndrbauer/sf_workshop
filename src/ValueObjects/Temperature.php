<?php

declare(strict_types=1);

namespace App\ValueObjects;

class Temperature
{
    private float $value;

    public function __construct(float $value)
    {
        if ($value <= -320.0) {
            throw new \RuntimeException(sprintf('Value "%s" for Temparature is invalid', $value));
        }

        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}