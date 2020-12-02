<?php

declare(strict_types=1);

namespace App\ValueObjects;

class Humidity
{
    private float $value;

    public function __construct(float $value)
    {
        if ($value < 0 || $value > 1) {
            throw new \RuntimeException(sprintf('Value "%s" for Humidity is invalid', $value));
        }

        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}