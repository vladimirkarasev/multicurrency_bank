<?php

namespace MultiCurrency\Currency;

final class EurCurrency extends AbstractCurrency
{
    protected readonly string $name;
    protected readonly string $code;
    protected readonly int $num;
    protected readonly int $decimal;

    public function __construct()
    {
        $this->name = 'Euro';
        $this->code = 'EUR';
        $this->num = 978;
        $this->decimal = 2;
    }
}