<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Tests\Currency;

use Generator;
use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyDto;
use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyInterface;

trait CurrencyTrait
{
    public function getCurrencyList(): Generator
    {
        yield $this->currencyFactory(
            name: 'Russian ruble',
            code: 'RUB',
            num: 643,
            decimal: 2,
            symbol: '₽'
        );
        yield $this->currencyFactory(
            name: 'Euro',
            code: 'EUR',
            num: 978,
            decimal: 2,
            symbol: '€'
        );
        yield $this->currencyFactory(
            name: 'United States dollar',
            code: 'USD',
            num: 840,
            decimal: 2,
            symbol: '$'
        );
    }

    public function currencyFactory(string $name, string $code, int $num, int $decimal, string $symbol = ''): CurrencyInterface
    {
        return new CurrencyDto(
            name: $name, code: $code, num: $num, decimal: $decimal, symbol: $symbol
        );
    }
}