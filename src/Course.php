<?php
declare(strict_types=1);

namespace MultiCurrency\Bank;

use Yiisoft\Arrays\ArrayHelper;

/**
 * Объект по работе с курсами валют. Объект умеет конвертировать валюту ( @see exchangeCurrency() )
 */
class Course
{
    public function __construct(
        public array $configs = []
    )
    {

    }

    /**
     * Добавиль новый курс или обновлить текущий
     * @param string $from
     * @param string $to
     * @param float $amount
     * @return $this
     */
    public function setCourse(string $from, string $to, float $amount): self
    {
        ArrayHelper::setValue($this->configs, [$from, $to], $amount);

        return $this;
    }

    /**
     * Конвертировать курс валюты
     * @param string $from
     * @param string $to
     * @param float $amount
     * @return float
     * @throws \Exception
     */
    public function exchangeCurrency(string $from, string $to, float $amount): float
    {
        $course = ArrayHelper::getValue($this->configs, [$from, $to]);

        if ($course === null) throw new \Exception('Курс валюты не задан!');

        if (!$course || $course < 0) throw new \Exception('Курс не может быть больше или равно 0!');

        return $amount * $course;
    }
}
