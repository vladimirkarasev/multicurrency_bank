<?php

namespace MultiCurrency\Wallet;


use MultiCurrency\Balance\BalanceInterface;
use MultiCurrency\Currency\CurrencyInterface;

abstract class AbstractWallet implements WalletInterface
{
    public function __construct(
        protected BalanceInterface $balance,
    )
    {
    }

    public function getCurrency(): CurrencyInterface
    {
        return $this->getBalance()->getCurrency();
    }

    public function getBalance(): BalanceInterface
    {
        return $this->balance;
    }
}