<?php

namespace MultiCurrency\Wallet\Collection;

use MultiCurrency\Collection\CollectionInterface;
use MultiCurrency\Wallet\AbstractWallet;
use MultiCurrency\Wallet\WalletInterface;

interface WalletCollectionInterface extends CollectionInterface
{
    /**
     * Добавить кошелек
     * Если не указан $key ключ то он сгенерируется автоматически
     * @param AbstractWallet $wallet
     * @param ?string $key
     * @return string
     */
    public function add(string $key, AbstractWallet $object);

//    public function add(  AbstractWallet $wallet, ?string $key = null): string;

    /**
     * Удалить из списка кошелек
     * Если указан параметр $mergeKey то при удалении остаток перейдет в указанный кошелек
     * @param string $key
     * @param string|null $mergeKey
     * @return self
     */
    public function remove(string $key, ?string $mergeKey = null): self;

    /**
     * Получить кошелек
     * @param string $key
     * @return WalletInterface
     */
    public function get(string $key): WalletInterface;
}