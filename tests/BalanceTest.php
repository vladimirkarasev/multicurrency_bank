<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Tests;

use PHPUnit\Framework\TestCase;
use VladimirKarasev\MultiCurrency\Balance\Balance;
use VladimirKarasev\MultiCurrency\Balance\Extension\BalanceInsufficientFundsException;
use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyDto;
use VladimirKarasev\MultiCurrency\Tests\Currency\CurrencyTrait;

class BalanceTest extends TestCase
{
    use CurrencyTrait;
    use BalanceTrait;

    private ?CurrencyDto $currency;
    private ?int $unit;
    private ?Balance $balance;

    protected function setUp(): void
    {
        $this->unit = 800;
        $this->currency = $this->getCurrencyList()->current();

        $this->balance = $this->balanceFactory(
            $this->currency,
            $this->unit,
        );
    }

    public function testBase()
    {
        $this->assertSame($this->unit, $this->balance->get());
    }

    public function testReplenish()
    {
        $quantity = 200;

        $balance = clone $this->balance;
        $balanceUnitBefore = $this->balance->get();

        $balance->replenish($quantity);

        $balanceUnitAfter = $balance->get();

        $this->assertSame($balanceUnitBefore + $quantity, $balanceUnitAfter);
    }

    /**
     * @throws BalanceInsufficientFundsException
     */
    public function testWriteOfTrue()
    {
        $quantity = 200;

        $balance = $this->balanceWriteOf($quantity);
        $balanceUnitBefore = $this->balance->get();

        $this->assertSame($balanceUnitBefore - $quantity, $balance->get());
    }

    /**
     * @throws BalanceInsufficientFundsException
     */
    public function testWriteOfFalse()
    {
        $this->expectException(BalanceInsufficientFundsException::class);
        $this->balanceWriteOf(900);
    }

    public function testGetCurrency()
    {
        $this->assertInstanceOf($this->currency::class, $this->balance->getCurrency());
    }

    private function cloneBalance(): ?Balance
    {
        return clone $this->balance;
    }

    /**
     * @throws BalanceInsufficientFundsException
     */
    private function balanceWriteOf(int $quantity): Balance
    {
        $prototypeBalance = $this->cloneBalance();
        $prototypeBalance->writeOf($quantity);
        return $prototypeBalance;
    }
}