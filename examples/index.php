<?php

use App\Currencies\Eur;
use App\Currencies\Rub;
use App\Currencies\Usd;
use MultiCurrency\Bank\Wallet;
use MultiCurrency\Bank\Course;

require '../vendor/autoload.php';

spl_autoload_register(function ($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }

    return false;
})
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сценарии</title>
</head>
<body>
    <h2>Сценарий 1</h2>
    <p>Клиент открывает мультивалютный счет, включающий сбережения в 3-х валютах с основной валютой российский рубль, и
        пополняет его следующими суммами: 1000 RUB, 50 EUR, 40 USD</p>

    <?php
    $wallet = new Wallet([
        'defaultWallet' => Rub::NAME,
        'wallets' => [
        ],
    ], new Course([
        Eur::NAME => [
            Rub::NAME => 1/80,
            Usd::NAME => 1,
        ],
        Usd::NAME => [
            Rub::NAME => 1/70,
            Eur::NAME => 1,
        ],
        Rub::NAME => [
            Eur::NAME => 80,
            Usd::NAME => 70,
        ],
    ]));

    /** Добавлюем 3 новых кошелька с валютой */
    $wallet->add(Rub::NAME, 1000);
    $wallet->add(Usd::NAME, 40);
    $wallet->add(Eur::NAME, 50);

    /** Устанавливаем основную валюту */
    $wallet->setDefaultWallet(Rub::NAME);

    /** Список поддержываемых валют */
    $supportCurrency = $wallet->getSupportCurrency();
    ?>

    <h3>Список поддержываемых валют</h3>
    <pre><?php var_dump($supportCurrency) ?></pre>
    <br>

    <?php
    $balance = $wallet->one(Rub::NAME);
    ?>
    <h3>Пополнение рублевого баланса: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после пополнения: </b> <?= $balance->credit(1000)->get() ?>  </p>
    <br>
    <?php
    $balance = $wallet->one(Eur::NAME);
    ?>
    <h3>Пополнение баланса в евро: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после пополнения: </b> <?= $balance->credit(50)->get() ?>  </p>
    <br>

    <?php
    $balance = $wallet->one(Usd::NAME);
    ?>
    <h3>Пополнение долларового баланса: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после пополнения: </b> <?= $balance->credit(50)->get() ?>  </p>

    <br>
    <br>
    <h2>Сценарий 2</h2>

    <p>Клиент хочет увидеть суммарный баланс счета в основной валюте, либо в валюте на выбор.</p>

    <?php $balance = $wallet->one(Rub::NAME) ?>
    <p>Баланс рублевого кошелька: <b><?= $balance->get() ?></b></p>

    <?php $balance = $wallet->one(Eur::NAME) ?>
    <p>Баланса в евро: <b><?= $balance->get() ?></b></p>

    <?php $balance = $wallet->one(Usd::NAME) ?>
    <p>Баланс долларового кошелька: <b><?= $balance->get() ?></b></p>

    <br>
    <br>
    <h2>Сценарий 3</h2>

    <p>Клиент совершает операции пополнения/списания со счета.</p>
    <br>

    <?php $balance = $wallet->one(Rub::NAME) ?>
    <h3>Пополнение рублевого баланса: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после пополнения 1000 руб.: </b> <?= $balance->credit(1000)->get() ?> </p>
    <br>

    <?php $balance = $wallet->one(Eur::NAME) ?>
    <h3>Пополнение баланса в евро: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после пополнения $50: </b> <?= $balance->credit(50)->get() ?>  </p>
    <br>

    <?php $balance = $wallet->one(Usd::NAME) ?>
    <h3>Списание с долларового баланса: </h3>
    <p> <b>Баланс до пополнения: </b> <?= $balance->get() ?> </p>
    <p> <b>Баланс после списания €10: </b> <?= $balance->debit(10)->get() ?>  </p>

    <br>
    <br>
    <h2>Сценарий 4</h2>
    <p>Общий баланс до поресчитки <?= $wallet->getTotalBalance() ?></p>

    <p>Банк меняет курс валюты для EUR и USD по отношению к рублю на 150 и 100 соответственно</p>
    <?php

    $wallet->course->setCourse(Eur::NAME, Rub::NAME, 1/150);
    $wallet->course->setCourse(Rub::NAME, Eur::NAME, 150);
    $wallet->course->setCourse(Usd::NAME, Rub::NAME, 1/100);
    $wallet->course->setCourse(Rub::NAME, Eur::NAME, 100);

    ?>

    <br>
    <br>
    <h2>Сценарий 5</h2>
    <p>Клиент хочет увидеть суммарный баланс счета в рублях, после изменения курса валют.</p>
    <p>Общий баланс после поресчитки <?= $wallet->getTotalBalance() ?></p>


    <br>
    <br>
    <h2>Сценарий 6</h2>
    <p>После этого клиент решает изменить основную валюту счета на EUR, и запрашивает текущий баланс</p>

    <?php $wallet->setDefaultWallet(Eur::NAME)?>
    <p>Общий баланс после смены основной валюты <?= $wallet->getTotalBalance() ?></p>

    <br>
    <br>
    <h2>Сценарий 7</h2>
    <p>Чтобы избежать дальнего ослабления рубля клиент решает сконвертировать рублевую часть счета в EUR, и запрашивает баланс</p>

    <p>Баланс счета в евро до перемещения денежных средств: <?= $wallet->one(Eur::NAME)->get() ?></p>
    <?php
    $amount = 1000;
    $wallet->one(Rub::NAME)->debit($amount);
    $wallet->credit(Eur::NAME, $wallet->course->exchangeCurrency( Eur::NAME, Rub::NAME, $amount));
    ?>
    <p>Баланс рублевого счета: <?= $wallet->one(Rub::NAME)->get() ?></p>
    <p>Баланс счета в евро: <?= $wallet->one(Eur::NAME)->get() ?></p>
    <p>Общий баланс <?= $wallet->getTotalBalance() ?></p>

    <br>
    <br>
    <h2>Сценарий 8</h2>
    <p>Банк меняет курс валюты для EUR к RUB на 120</p>

    <?php $wallet->course->setCourse(Eur::NAME,Rub::NAME, 1/120) ?>
    <?php $wallet->course->setCourse(Rub::NAME, Eur::NAME, 120) ?>

    <br>
    <br>
    <h2>Сценарий 9</h2>
    <p>После изменения курса клиент проверяет, что баланс его счета не изменился</p>
    <p>Баланс счета в евро: <?= $wallet->one(Eur::NAME)->get() ?></p>

    <br>
    <br>
    <h2>Сценарий 10</h2>
    <p>Банк решает, что не может больше поддерживать обслуживание следующих валют EUR и USD. Согласовывает с клиентом изменение основной валюты счета на RUB, с конвертацией балансов неподдерживаемых валют.</p>
    <?php

    $wallet->setDefaultWallet(Rub::NAME);
    $wallet->dropWallet(Usd::NAME);
    $wallet->dropWallet(Eur::NAME);

    $supportCurrency = $wallet->getSupportCurrency();

    ?>

    <h3>Список поддержываемых валют</h3>
    <pre><?php var_dump($supportCurrency) ?></pre>
    <br>

    <p>Баланс счета в рублях: <?= $wallet->one()->get() ?></p>



</body>
</html>
