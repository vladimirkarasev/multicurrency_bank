<?php
declare(strict_types=1);

namespace MultiCurrency\Bank;

use Yiisoft\Arrays\ArrayHelper;

/**
 * Обект для управленя кошельками
 */
class Wallet
{
    public function __construct(
        protected array $configWallet = [],
        public ?Course  $course = null,
    )
    {
        $configs = $this->configWallet;
        $wallets = ArrayHelper::getValue($configs, 'wallets');

        foreach ($wallets as &$wallet) {
            if (!($wallet instanceof Balance)) $wallet = new Balance((float) $wallet);
        }

        $this->updateConfigs('wallets', $wallets);
    }

    /**
     * Добавить кошелек
     * @param string $currency Валюта
     * @param Balance|float $balance Баланс
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
     * @return array Масив с поддерживаемыми валютами
     */
    public function getSupportCurrency(): array
    {
        return array_keys($this->getWallets());
    }

    /**
     * @param string|null $currency валюта, в случае если она не указата то береться валюда по умолчанию
     * @return Balance
     * @throws \Exception
     */
    public function one(?string $currency = null): Balance
    {
        $currency = $currency ?? $this->getDefaultWallet();

        $wallets = $this->getWallets();
        $wallet = ArrayHelper::getValue($wallets, $currency, []);

        if (!$wallet) throw new \Exception('Не найден кошелек ' . $currency);

        return $wallet;
    }

    /**
     * Установть валюту по умолчанию
     * @param string $currency Валюта
     * @return $this
     */
    public function setDefaultWallet(string $currency): self
    {
        $this->updateConfigs('defaultWallet', $currency);
        return $this;
    }

    /**
     * Получить общей даланс все валютных кошельков
     * @param string|null $currency Валюта
     * @return float
     * @throws \Exception
     */
    public function getTotalBalance(?string $currency = null): float
    {
        $wallets = $this->getWallets();
        $totalBalance = 0;

        $currency = $currency ?? $this->getDefaultWallet();

        /** @var Balance $balance */

        foreach ($wallets as $currencyWallet => $balance) {
            match ($currencyWallet) {
                $currency => $totalBalance += $balance->get(),
                default => $totalBalance += $this->course->exchangeCurrency($currency, $currencyWallet, $balance->get())
            };
        }

        return $totalBalance;
    }

    /**
     * Получить баланс одной конкретной валюты
     * @param string|null $currency Валюта
     * @return float
     * @throws \Exception
     */
    public function getBalance(?string $currency = null): float
    {
        $currency = $currency ?? $this->getDefaultWallet();
        $wallet = $this->one($currency);

        return $wallet->get();
    }

    /**
     * Пополнить баланс одной конкретной валюты
     * @param string|null $currency Валюта
     * @param float $amount Сумма пополения
     * @return $this
     * @throws \Exception
     */
    public function credit(?string $currency = null, float $amount = 0): self
    {
        $currency = $currency ?? $this->getDefaultWallet();
        $wallet = $this->one($currency);

        $wallet->credit($amount);
        return $this;
    }

    /**
     * Списать с баланс одной конкретной валюты
     * @param string|null $currency
     * @param float $amount Сумма списания
     * @return $this
     * @throws \Exception
     */
    public function debet(?string $currency = null, float $amount = 0): self
    {
        $currency = $currency ?? $this->getDefaultWallet();
        $wallet = $this->one($currency);

        $wallet->debit($amount);

        return $this;
    }

    /**
     * Удалить кошелек
     * @param string $currency Валюта
     * @return $this
     * @throws \Exception
     */
    public function dropWallet(string $currency): self
    {
        $currentCurrency = $this->getDefaultWallet();

        if ($currency === $currentCurrency) throw new \Exception('Нельзя удалить основную валюту');

        /** @var Balance $dropWallet */
        $dropWallet = ArrayHelper::remove($this->configWallet, ['wallets', $currency]);

        if (!$dropWallet) throw new \Exception('Такой валюты не существует!');

        $amount = $this->course->exchangeCurrency($currentCurrency, $currency, $dropWallet->get());

        $currentBalance = $this->one($currentCurrency);

        $currentBalance->credit($amount);

        return $this;
    }

    /**
     * Получить название валюты по умолчанию, указанная при инициализации или с помощью метода (@see setDefaultWallet())
     * @return mixed
     */
    protected function getDefaultWallet()
    {
        $configs = $this->configWallet;
        return ArrayHelper::getValue($configs, 'defaultWallet');
    }

    /**
     * Получить все кошельки
     * @return array
     */
    protected function getWallets(): array
    {
        $configs = $this->configWallet;

        return ArrayHelper::getValue($configs, 'wallets', []);
    }

    /**
     * Обновление конфигурации
     * @param array|string $key ключ
     * @param mixed $value значения ключа
     * @return self
     */
    protected function updateConfigs(array|string $key, mixed $value): self
    {
        ArrayHelper::setValue($this->configWallet, $key, $value);

        return $this;
    }
}
