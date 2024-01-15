<?php

namespace MultiCurrency\Currency;

abstract class AbstractCurrency implements CurrencyInterface
{
    readonly protected string $name;
    readonly protected string $code;
    readonly protected int $num;
    readonly protected int $decimal;

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getNum(): int
    {
        return $this->num;
    }

    public function getDecimal(): int
    {
        return $this->decimal;
    }
}