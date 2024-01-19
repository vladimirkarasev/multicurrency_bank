<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Balance\Extension;

use Exception;
use Throwable;

class BalanceInsufficientFundsException extends Exception
{
    public function __construct(
        string     $message = "",
        int        $code = 0,
        ?Throwable $previous = null,
        int        $current = 0,
        int        $value = 0,
    )
    {
        if (!$message) {
            $message = sprintf(
                'Insufficient funds. Current balance %s, requested debit %s.',
                $current,
                $value,
            );
        }
        parent::__construct($message, $code, $previous);
    }
}