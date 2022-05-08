# Управление мультивалютными счетами

Пакет предназначет для работы с кошельками и валютами. 

Баланс кошельков можно пополнять , списывать , задавать и получать текущий баланс.

Также пакет умеет конвертировать валюту. 

## Установка
``` shell
git clone https://github.com/admirallolka/multicurrency_bank.git

composer install
```

## Использование

### Работа с кошельками

#### Инициализация
```php
<?php
    use MultiCurrency\Bank\Wallet;
    use MultiCurrency\Bank\Course;
?>
<?php
    $params = [
        /** Валюта по умолчанию */
        'defaultWallet' => "RUR",
        /** Список валют и их изначальный балас */ 
        'wallets' => [
            "RUR" => 1000
        ],
    ]
    
    /** @var Course $course Объект по работе с курсами валют */
    $course = new Course([
        "RUR" => [
            "USD" => 70         
        ],
        "USD" => [
            "RUR" => 1/70        
        ]
    ]) 
    
    $wallet = new Wallet($params, $course);
?>
```

#### Добавить кошелек с валютой
```php
<?php
    $wallet->add("USD", 50) // Название валюты , изначальный баланс 
?>
```
#### Установить валюту по умолчанию
```php
<?php
    $wallet->setDefaultWallet("RUR") // Название валюты , изначальный баланс 
?>
```
#### Список поддержываемых валют
Возвращает масив с текущими валютами
```php
<?php 
    $supportCurrency = $wallet->getSupportCurrency(); // ["RUR", "USD"]
?>
```
### Работа с балансом кошелька
#### Получить текущий баланс кошелька

```php
<?php
    $balance = $wallet->one("USD"); // Кошелек
    $balance->get(); // 50
?>
```
или
```php
<?php
    $balance->getBalance("USD"); // Если валюта не введена, то валюта берется из значения по умолчанию
?>
```


#### Пополнение кошелька 
```php
<?php
    $balance = $wallet->one("USD"); // Кошелек
    $balance->credit(50); 
    $balance->get(); // 100
?>
```
или
```php
<?php
    $balance->credit("USD", 50); // Если валюта не введена, то валюта берется из значения по умолчанию
?>
```

#### Списание с кошелька
```php
<?php
    $balance = $wallet->one("USD"); // Кошелек
    $balance->debit(50); 
    $balance->get(); // 50
?>
```
или
```php
<?php
    $balance->debet("USD", 50); // Если валюта не введена, то валюта берется из значения по умолчанию
?>
```

### Удаление кошелька
```php
<?php
    $walet->dropWallet("USD"); // Метод удаляет валюту и конвертирует остаток, пополняя кошелек по умолчанию
?>
```

### Работа с курсом 

#### Изменение котировок курса
```php
<?php
    $course = $walet->course;
    
    $wallet->course->setCourse("USD", "RUR", 1/120) // Рубль к доллару
    $wallet->course->setCourse("RUR", "USD", 120) // Доллар к Рублю
?>
```

#### Конвертирование валюты
```php
<?php
    $course = $walet->course;
    
    $wallet->course->exchangeCurrency( "USD", "RUR", 1000) // Переводим рубли в доллары
?>
```



