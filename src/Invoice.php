<?php

declare(strict_types=1);

namespace MultiCurrency\Bank;

use MultiCurrency\Bank\Currencies\CurrencyInterface;
use Yiisoft\Arrays\ArrayHelper;

class Invoice
{
    public function __construct(
        protected array $configs,
        public Wallet $wallet,
    )
    {

        $this->init();
    }

    /**
     * Обновление конфигурации
     * @param array $configs
     * @return $this
     */
    public function setConfigs(array $configs = []): self
    {
        $this->configs = $configs;
        return $this;
    }

    /**
     * Инициализация компонента
     * @return void
     */
    public function init(): void
    {

    }

    /**
     * Добавить новую валюту
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function addWallet(CurrencyInterface $currency): self
    {
        return $this;
    }
}
