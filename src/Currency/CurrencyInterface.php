<?php

namespace MultiCurrency\Currency;

interface CurrencyInterface
{
    /**
     * Код валюты
     * @return mixed
     */
    public function getCode(): string;

    /**
     * Номер валюты
     * @return mixed
     */
    public function getNum(): int;

    /**
     * Название валюты
     * @return mixed
     */
    public function getName(): string;

    /**
     * Чисет после азпятой
     * @return mixed
     */
    public function getDecimal(): int;
}