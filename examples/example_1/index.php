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
    <title>Сценарий 1</title>
</head>
<body>
    <h2>Сценарий 1</h2>

    <p>Клиент открывает мультивалютный счет, включающий сбережения в 3-х валютах с основной валютой российский рубль, и пополняет его следующими суммами: 1000 RUB, 50 EUR, 40 USD</p>

    <?php
        $wallet = new Wallet([
            'defaultWallet' => Rub::NAME,
            'wallets' => [],
        ]);

        /** Добавлюем 3 новых кошелька с валютой */
        $wallet->add(Rub::NAME);
        $wallet->add(Usd::NAME);
        $wallet->add(Eur::NAME);

        /** Устанавливаем основную валюту */
        $wallet->setDefaultWallet(Rub::NAME);

        /** Список поддержываемых валют */
        $supportCurrency = $wallet->getSupportCurrency();
    ?>

    <h3>Список поддержываемых валют</h3>
    <pre><?php var_dump($supportCurrency) ?></pre>
    <br>

    <?php
    $balance = $wallet->get(Rub::NAME);
    ?>
    <h3>Пополнение рублевого баланса: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после пополнения: </b> <?= $balance->credit(1000)->get() ?>  </p>
    <br>
    <?php
    $balance = $wallet->get(Eur::NAME);
    ?>
    <h3>Пополнение баланса в евро: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после пополнения: </b> <?= $balance->credit(50)->get() ?>  </p>
    <br>

    <?php
    $balance = $wallet->get(Usd::NAME);
    ?>
    <h3>Пополнение долларового баланса: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после пополнения: </b> <?= $balance->credit(50)->get() ?>  </p>
</body>
</html>

