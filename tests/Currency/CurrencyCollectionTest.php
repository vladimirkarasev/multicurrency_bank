<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Tests\Currency;

use PHPUnit\Framework\TestCase;
use VladimirKarasev\MultiCurrency\Currency\Collection\Exceptions\CurrencyAlreadyException;
use VladimirKarasev\MultiCurrency\Currency\Collection\CurrencyCollection;
use VladimirKarasev\MultiCurrency\Currency\Collection\Exceptions\CurrencyNotFoundException;
use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyInterface;

class CurrencyCollectionTest extends TestCase
{
    private ?CurrencyCollection $currencyCollection;

    /**
     * @throws CurrencyAlreadyException
     */
    public function setUp(): void
    {
        $this->currencyCollection = new CurrencyCollection();

        $this->currencyCollection->add(
            $this->currencyCollection->currencyFactory(
                name: 'Russian ruble',
                code: 'RUB',
                num: 643,
                decimal: 2,
                symbol: '₽'
            ),
            $this->currencyCollection->currencyFactory(
                name: 'Euro',
                code: 'EUR',
                num: 978,
                decimal: 2,
                symbol: '€'
            ),
            $this->currencyCollection->currencyFactory(
                name: 'United States dollar',
                code: 'USD',
                num: 840,
                decimal: 2,
                symbol: '$'
            ),
        );
    }

    /**
     * @throws CurrencyAlreadyException
     */
    public function testAddCurrency()
    {
        $this->expectException(CurrencyAlreadyException::class);

        $this->currencyCollection->add(
            $this->currencyCollection->currencyFactory(
                name: 'United States dollar',
                code: 'USD',
                num: 840,
                decimal: 2,
                symbol: '$'
            ),
        );
    }

    public function testHasCurrency()
    {
        $this->assertTrue($this->currencyCollection->has('RUB'));
        $this->assertFalse($this->currencyCollection->has('AMD'));
    }

    /**
     * @throws CurrencyNotFoundException
     */
    public function testGetCurrency()
    {
        $currencyName = 'RUB';
        $currency = $this->currencyCollection->get($currencyName);
        $this->assertInstanceOf(CurrencyInterface::class, $currency);
        $this->assertSame($currencyName, $currency->getCode());

        // Not Found
        $currencyName = 'AMD';
        $this->expectException(CurrencyNotFoundException::class);
        $currency = $this->currencyCollection->get($currencyName);
    }

    public function testCurrencyList()
    {
        foreach ($this->currencyCollection->getCurrencyList() as $currency) {
            $this->assertInstanceOf(CurrencyInterface::class, $currency);
        }
    }
}