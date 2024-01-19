<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Tests\Currency;

use PHPUnit\Framework\TestCase;
use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyDto;
use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyInterface;

class CurrencyTest extends TestCase
{
    use CurrencyTrait;

    private ?string $currencyName;
    private ?string $currencyCode;
    private ?string $symbol;
    private ?int $currencyNum;
    private ?int $currencyDecimal;

    private ?CurrencyDto $currency;

    protected function setUp(): void
    {
        $this->currencyName = 'Russian ruble';
        $this->currencyCode = 'RUB';
        $this->currencyNum = 643;
        $this->currencyDecimal = 2;
        $this->symbol = '₽';

        $this->currency = $this->currencyFactory(
            name: $this->currencyName,
            code: $this->currencyCode,
            num: $this->currencyNum,
            decimal: $this->currencyDecimal,
            symbol: $this->symbol,
        );
    }

    public function testBase()
    {
        $this->assertSame($this->currencyNum, $this->currency->getNum());
        $this->assertSame($this->currencyDecimal, $this->currency->getDecimal());
        $this->assertSame($this->currencyName, $this->currency->getName());
        $this->assertSame($this->currencyCode, $this->currency->getCode());
        $this->assertSame($this->symbol, $this->currency->getSymbol());

        $this->assertInstanceOf(CurrencyInterface::class, $this->currency);
    }
}