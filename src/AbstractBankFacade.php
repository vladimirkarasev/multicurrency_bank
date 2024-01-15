<?php

namespace MultiCurrency;

use StringBackedEnum;

abstract class AbstractBankFacade implements BankFacadeInterface
{
    public function __construct(protected StringBackedEnum $supportWallets)
    {
    }
}