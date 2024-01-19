<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Balance;

interface BalanceFormatInterface
{
    public static function format(BalanceInterface $balance);
}