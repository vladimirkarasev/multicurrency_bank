<?php

namespace MultiCurrency\Currency\Support;

use MultiCurrency\Currency\CurrencyInterface;

/**
 * Интерфейс поддерживаемых валют
 */
interface SupportCurrencyCollectionInterface
{
    /**
     * Добавить валюту в список поддерживаемых
     * @param CurrencyInterface $currency
     * @param string $key
     * @return void
     */
    public function add(CurrencyInterface $currency, string $key): void;

    /**
     * Удалить валюту из списка поддерживаемых
     * @param string $key
     * @return void
     */
    public function remove(string $key): void;
}