<?php

namespace MultiCurrency;

use MultiCurrency\Currency\EurCurrency;
use MultiCurrency\Currency\RubCurrency;
use MultiCurrency\Currency\UsdCurrency;

enum SupportWalletsEnum: string
{
    case Rub = RubCurrency::class;
    case Eur = EurCurrency::class;
    case Usd = UsdCurrency::class;
}
