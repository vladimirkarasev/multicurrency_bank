<?php

namespace MultiCurrency\Balance;

use MultiCurrency\Currency\CurrencyInterface;

abstract class AbstractBalance implements BalanceInterface
{
    public function __construct(
        protected CurrencyInterface $currency,
        protected int $balance
    ) {
    }

    public function getCurrency(): CurrencyInterface
    {
        return $this->currency;
    }

    public function get(): int
    {
        return $this->balance;
    }

    public function replenish(int $value): void
    {
        $this->balance += $value;
    }

    public function writeOf(int $value): void
    {
        $this->balance -= $value;
    }
}
