<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Currency\Dto;

interface CurrencyInterface
{
    /**
     * Get symbol currency
     * @return string
     */
    public function getSymbol(): string;

    /**
     * Код валюты
     * @return mixed
     */
    public function getCode(): string;

    /**
     * Номер валюты
     * @return int
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