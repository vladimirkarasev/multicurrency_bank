<?php

namespace MultiCurrency\Currency;

final class UsdCurrency extends AbstractCurrency
{
    protected readonly string $name;
    protected readonly string $code;
    protected readonly int $num;
    protected readonly int $decimal;

    public function __construct()
    {
        $this->name = 'United States dollar';
        $this->code = 'USD';
        $this->num = 840;
        $this->decimal = 2;
    }
}