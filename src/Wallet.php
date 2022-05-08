<?php
declare(strict_types=1);

namespace MultiCurrency\Bank;

use MultiCurrency\Bank\Currencies\CurrencyInterface;
use Yiisoft\Arrays\ArrayHelper;

class Wallet
{
    public function __construct(
        protected array $configWallet
    )
    {
        $configs = $this->configWallet;
        $wallets = ArrayHelper::getValue($configs, 'wallets');

        foreach ($wallets as &$wallet) {
            if (!($wallet instanceof Balance)) $wallet = new Balance($wallet);
        }

        $this->updateConfigs('wallets', $wallets);

        $this->init();
    }

    public function init(): void
    {

    }

    /**
     * Добавить счет
     * @param string $currency
     * @param Balance|float $balance
     * @return self
     */
    public function add(string $currency, Balance|float $balance = 0): self
    {
        $config = $this->configWallet;

        if (!($balance instanceof Balance)) {
            $balance = new Balance($balance);
        }

        $this->updateConfigs(['wallets', $currency], $balance);

        return $this;
    }

    /**
     * Получить поддерживаемую валюту
     * @return array [Usd, Eur, Rub]
     */
    public function getSupportCurrency(): array
    {
        return array_keys($this->getWallets());
    }

    /**
     * @param string|null $currency
     * @return Balance
     * @throws \Exception
     */
    public function get(?string $currency = null): Balance
    {
        $currency = $currency ?? $this->getDefaultWallet();

        $wallets = $this->getWallets();
        $wallet = ArrayHelper::getValue($wallets, $currency, []);

        if (!$wallet) throw new \Exception('Не найден кошелек ' . $currency);

        return $wallet;
    }

    /**
     * Установть валюту по умолчанию
     * @param string $currency
     * @return $this
     */
    public function setDefaultWallet(string $currency): self
    {
        $this->updateConfigs('defaultWallet', $currency);
        return $this;
    }

    protected function getDefaultWallet()
    {
        $configs = $this->configWallet;
        return ArrayHelper::getValue($configs, 'defaultWallet');
    }

    /**
     * Получить кошельки
     * @return array
     */
    protected function getWallets(): array
    {
        $configs = $this->configWallet;

        return ArrayHelper::getValue($configs, 'wallets', []);
    }

    /**
     * Обновление конфигов
     * @param array|string $key
     * @param mixed $value
     * @return self
     */
    protected function updateConfigs(array|string $key, mixed $value): self
    {
        ArrayHelper::setValue($this->configWallet, $key, $value);

        return $this;
    }
}
