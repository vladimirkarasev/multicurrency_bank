<?php

use MultiCurrency\Bank\Balance;
use MultiCurrency\Bank\Currencies\Eur;
use MultiCurrency\Bank\Currencies\Rub;
use MultiCurrency\Bank\Currencies\Usd;
use MultiCurrency\Bank\Invoice;
use MultiCurrency\Bank\Wallet;

require '../../vendor/autoload.php';

$invoiceConfigs = require_once '../configs/invoice.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сценарий 3</title>
</head>
<body>
    <h2>Сценарий 3</h2>

    <p>Клиент совершает операции пополнения/списания со счета.</p>
    <br>

    <?php
        $invoice = new Invoice($invoiceConfigs, new Wallet([
            'defaultWallet' => Rub::NAME,
            'wallets' => [
                Rub::NAME => 1000,
                Eur::NAME => 50,
                Usd::NAME => 40
            ],
        ]));
    ?>

    <?php $balance = $invoice->wallet->get(Rub::NAME) ?>
    <h3>Пополнение рублевого баланса: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после пополнения: </b> <?= $balance->credit(1000)->get() ?> </p>
    <br>

    <?php $balance = $invoice->wallet->get(Eur::NAME) ?>
    <h3>Пополнение баланса в евро: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после пополнения: </b> <?= $balance->credit(50)->get() ?>  </p>
    <br>

    <?php $balance = $invoice->wallet->get(Usd::NAME) ?>
    <h3>Списание с долларового баланса: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после пополнения: </b> <?= $balance->debit(10)->get() ?>  </p>
</body>
</html>

