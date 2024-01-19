<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Currency\Dto;

/**
 * Dto currency
 * @see https://en.wikipedia.org/wiki/ISO_4217
 */
final readonly class CurrencyDto implements CurrencyInterface
{
    /**
     * @param string $name
     * @param string $code
     * @param int $num
     * @param int $decimal
     * @param string $symbol
     */
    public function __construct(
        private string $name,
        private string $code,
        private int    $num,
        private int    $decimal,
        private string $symbol = ''
    )
    {
    }

    /**
     * Get currency name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get currency code
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Get currency num
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

    /**
     * Get currency decimal
     * @return int
     */
    public function getDecimal(): int
    {
        return $this->decimal;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }
}
