<?php

declare(strict_types=1);

namespace App\ValueObjects;

class Wind
{
    private float $value;

    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new \RuntimeException(sprintf('Value "%s" for Wind is invalid', $value));
        }
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}