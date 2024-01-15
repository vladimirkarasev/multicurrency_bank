<?php

namespace MultiCurrency\Wallet;

use MultiCurrency\Balance\BalanceInterface;
use MultiCurrency\Currency\CurrencyInterface;

interface WalletInterface
{
    public function getBalance(): BalanceInterface;

    public function getCurrency(): CurrencyInterface;
}