<?php
declare(strict_types=1);

namespace VladimirKarasev\MultiCurrency\Currency\Collection\Exceptions;

use Exception;
use Throwable;

class CurrencyAlreadyException extends Exception
{
    public function __construct(
        string     $message = "",
        int        $code = 0,
        ?Throwable $previous = null,
        ?string    $key = null
    )
    {
        if ($key && !$message) {
            $message = sprintf('A currency with this key "%s" has already been added', $key);
        }

        parent::__construct($message, $code, $previous);
    }
}