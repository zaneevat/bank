<?php

namespace App;

class Pair
{
    public function __construct(private string $from, private string $to)
    {
    }

    public function __toString(): string
    {
        return sprintf('%s_%s', $this->from, $this->to);
    }
}
