<?php

namespace MultiCurrency;

use MultiCurrency\Balance\BalanceInterface;
use MultiCurrency\Currency\CurrencyInterface;
use MultiCurrency\Wallet\Collection\WalletCollectionInterface;

interface BankFacadeInterface
{
    /**
     * Создается новый кошелек и добавляется в коллекцию если в коллекции не существует то, создается и коллекция
     * @return mixed
     */
    public function walletFactory(SupportWalletsEnum $currency, int $balance = 0);

    /**
     * Создание коллекции кошельков
     * @return WalletCollectionInterface
     */
    public function createCollection(): WalletCollectionInterface;

    /**
     * Получить список поддерживаемых валют
     * @return SupportWalletsEnum
     */
    public function getSupportWallets(): SupportWalletsEnum;
}