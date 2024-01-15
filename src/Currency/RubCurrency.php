<?php

namespace MultiCurrency\Currency;

final class RubCurrency extends AbstractCurrency
{
    protected readonly string $name;
    protected readonly string $code;
    protected readonly int $num;
    protected readonly int $decimal;

    public function __construct()
    {
        $this->name = 'Russian ruble';
        $this->code = 'RUB';
        $this->num = 643;
        $this->decimal = 2;
    }
}