<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Currency\Collection;

use VladimirKarasev\MultiCurrency\Currency\Collection\Exceptions\CurrencyAlreadyException;
use VladimirKarasev\MultiCurrency\Currency\Collection\Exceptions\CurrencyNotFoundException;
use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyDto;
use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyInterface;

/**
 * Класс для работы с коллекцией валюты
 */
abstract class AbstractCurrencyCollection implements CurrencyCollectionInterface
{
    private array $currencyList = [];

    /**
     * Добавить поддерживаемую валюту
     * @throws CurrencyAlreadyException
     */
    public function add(CurrencyInterface ...$currencyList): void
    {
        foreach ($currencyList as $currency) {
            if (isset($this->currencyList[$currency->getCode()]))
                throw new CurrencyAlreadyException(key: $currency->getCode());

            $this->currencyList[$currency->getCode()] = $currency;
        }
    }

    /**
     * ФАбрика создания валюты
     * @param string $name
     * @param string $code
     * @param int $num
     * @param int $decimal
     * @param string $symbol
     * @return CurrencyInterface
     */
    public function currencyFactory(string $name, string $code, int $num, int $decimal, string $symbol = ''): CurrencyInterface
    {
        return new CurrencyDto(
            name: $name, code: $code, num: $num, decimal: $decimal, symbol: $symbol
        );
    }

    /**
     * Удаление валюты по коду валюты
     * @param string $key code currency
     * @return void
     * @throws CurrencyNotFoundException
     */
    public function remove(string $key): void
    {
        if (!$this->has($key)) throw new CurrencyNotFoundException(key: $key);
        unset($this->currencyList[$key]);
    }

    /**
     * Получить список валюты
     * @return CurrencyInterface[]
     */
    public function getCurrencyList(): array
    {
        return $this->currencyList;
    }

    /**
     * Существует ли валюта
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->currencyList[$key]);
    }

    /**
     * Получить валюту по коду
     * @throws CurrencyNotFoundException
     */
    public function get(string $key): CurrencyInterface
    {
        if (!$this->has($key)) throw new CurrencyNotFoundException(key: $key);
        return $this->currencyList[$key];
    }
}