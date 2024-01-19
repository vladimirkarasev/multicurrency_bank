<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Balance;

use VladimirKarasev\MultiCurrency\Currency\Dto\CurrencyInterface;

/**
 * Class for managing balance
 */
interface BalanceInterface
{
    /**
     * Get current currency
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface;

    /**
     * Get balance
     * @return mixed
     */
    public function get(): int;

    /**
     * Replenish balance
     * @param int $value
     * @return void
     */
    public function replenish(int $value): void;

    /**
     * Write off from balance
     * @param int $value
     * @return void
     */
    public function writeOf(int $value): void;
}