<?php

namespace MultiCurrency\Balance;

use MultiCurrency\Currency\CurrencyInterface;

interface BalanceInterface
{
    /**
     * Получить текущею валюту
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface;

    /**
     * Получить баланс
     * @return mixed
     */
    public function get(): int;

    /**
     * Пополнить баланс
     * @param int $value
     * @return void
     */
    public function replenish(int $value): void;

    /**
     * Списать
     * @param int $value
     * @return void
     */
    public function writeOf(int $value): void;
}