<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Balance;

use VladimirKarasev\MultiCurrency\Balance\Extension\BalanceInsufficientFundsException;
use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyInterface;

abstract class AbstractBalance implements BalanceInterface
{
    public function __construct(
        protected CurrencyInterface $currency,
        protected int               $balance
    )
    {
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

    /**
     * @param int $value
     * @return void
     * @throws BalanceInsufficientFundsException
     */
    public function writeOf(int $value): void
    {
        if ($this->get() < $value) throw new BalanceInsufficientFundsException(
            current: $this->get(), value: $value
        );

        $this->balance -= $value;
    }
}
