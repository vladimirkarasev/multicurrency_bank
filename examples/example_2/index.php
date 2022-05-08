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
    <title>Сценарий 2</title>
</head>
<body>
    <h2>Сценарий 2</h2>

    <p>Клиент хочет увидеть суммарный баланс счета в основной валюте, либо в валюте на выбор.</p>

    <?php
    $wallet = new Wallet([
        'defaultWallet' => Rub::NAME,
        'wallets' => [
            Rub::NAME => 1000,
            Eur::NAME => 50,
            Usd::NAME => 40
        ],
    ]);
    ?>

    <?php $balance = $wallet->get(Rub::NAME) ?>
    <p>Баланс рублевого кошелька: <b><?= $balance->get() ?></b></p>

    <?php $balance = $wallet->get(Eur::NAME) ?>
    <p>Баланса в евро: <b><?= $balance->get() ?></b></p>

    <?php $balance = $wallet->get(Usd::NAME) ?>
    <p>Баланс долларового кошелька: <b><?= $balance->get() ?></b></p>
</body>
</html>

