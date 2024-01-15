<?php

namespace MultiCurrency\Balance;

use MultiCurrency\Currency\CurrencyInterface;

interface BalanceFormatInterface
{
    public static function format(BalanceInterface $balance);
}