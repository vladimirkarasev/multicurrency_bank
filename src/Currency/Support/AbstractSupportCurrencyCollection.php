<?php

namespace MultiCurrency\Currency\Support;

use MultiCurrency\Currency\CurrencyInterface;
use MultiCurrency\Currency\Support\Exceptions\CurrencyAlreadyException;

abstract class AbstractSupportCurrencyCollection implements SupportCurrencyCollectionInterface
{
    protected array $currencyList = [];

    /**
     * @throws CurrencyAlreadyException
     */
    public function add(CurrencyInterface $currency, string $key): void
    {
        if (isset($this->currencyList[$key]))
            throw new CurrencyAlreadyException(key: $key);

        $this->currencyList[$key] = $currency;
    }

    public function remove(string $key): void
    {

    }
}