<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Currency\Collection;

use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyInterface;

/**
 * Интерфейс поддерживаемых валют
 */
interface CurrencyCollectionInterface
{
    /**
     * Добавить валюту в список поддерживаемых
     * @param CurrencyInterface $currency
     * @return void
     */
    public function add(CurrencyInterface $currency): void;

    /**
     * Создать валюту
     * @param string $name
     * @param string $code
     * @param int $num
     * @param int $decimal
     * @param string $symbol
     * @return CurrencyInterface
     */
    public function currencyFactory(string $name, string $code, int $num, int $decimal, string $symbol = ''): CurrencyInterface;

    /**
     * Список валют
     * @return CurrencyInterface[]
     */
    public function getCurrencyList(): array;

    /**
     * Существует ли валюта
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Получить валюту
     * @param string $key
     * @return CurrencyInterface
     */
    public function get(string $key): CurrencyInterface;

    /**
     * Удалить валюту из списка поддерживаемых
     * @param string $key
     * @return void
     */
    public function remove(string $key): void;
}