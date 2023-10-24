<?php

namespace App;

class Money implements Expression
{
    public function __construct(public int $amount, public string $currency)
    {
    }

    public function equals(object $object): bool
    {
        assert($object instanceof Money);
        return $this->amount === $object->amount && $this->currency === $object->currency;
    }

    public static function dollar(int $amount): Money
    {
        return new Money($amount, 'USD');
    }

    public static function franc(int $amount): Money
    {
        return new Money($amount, 'CHF');
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function times(int $multiplier): Expression
    {
        return new Money($this->amount * $multiplier, $this->currency);
    }

    public function plus(Expression $addend): Expression
    {
        return new Sum($this, $addend);
    }

    public function reduce(Bank $bank, string $to): Money
    {
        $rate = $this->currency === 'CHF' && $to === 'USD' ? 2 : 1;
        return new Money($this->amount / $rate, $to);
    }
}
