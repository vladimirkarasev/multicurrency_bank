<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Tests;

use VladimirKarasev\MultiCurrency\Balance\Balance;
use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyInterface;

trait BalanceTrait
{
    public function balanceFactory(
        CurrencyInterface $currency,
        int               $unit = 0,
    ): Balance
    {
        return new Balance($currency, $unit);
    }
}