<?php

use MultiCurrency\Bank\Balance;
use MultiCurrency\Bank\Currencies\Eur;
use MultiCurrency\Bank\Currencies\Rub;
use MultiCurrency\Bank\Currencies\Usd;
use MultiCurrency\Bank\Invoice;
use MultiCurrency\Bank\Wallet;

require '../vendor/autoload.php';
$invoiceConfigs = require_once 'configs/invoice.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сценарий 1</title>
</head>
<body>
    <h2>Сценарий 1</h2>

    <p>Клиент открывает мультивалютный счет, включающий сбережения в 3-х валютах с основной валютой российский рубль, и пополняет его следующими суммами: 1000 RUB, 50 EUR, 40 USD</p>

    <?php
        $invoice = new Invoice($invoiceConfigs, new Wallet([
            'defaultWallet' => Rub::NAME,
            'wallets' => [
                Eur::NAME => 100,
                Rub::NAME => 2000,
//                Usd::NAME => 500,
            ],
        ]));

        $wallet = $invoice->wallet;

        $balance = $wallet->get(Rub::NAME);

        var_dump( $balance->get() );

        $wallet->add(Usd::NAME, new Balance(100));

        $balance = $wallet->get(Usd::NAME);

        var_dump($balance->get());

        $balance = $wallet->get();

        var_dump($balance->get());



    ?>
</body>
</html>

