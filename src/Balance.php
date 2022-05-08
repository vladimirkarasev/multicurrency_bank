<?php
declare(strict_types=1);

namespace MultiCurrency\Bank;

/**
 * Объект для управления балансом
 * Этот обект выполнят роль пополнения, списания и просмотра средств
 */
class Balance
{

    public function __construct(
        public float $amount = 0
    )
    {

    }

    /**
     * Пополнить баланс
     * @param float $amount Сумма пополнения
     * @return $this
     */
    public function credit(float $amount): self
    {
        $this->amount += $amount;
        return $this;
    }

    /**
     * Списать с баланса
     * @param float $amount Сумма списания
     * @return $this
     * @throws \Exception
     */
    public function debit(float $amount): self
    {
        $currentAmount = $this->amount;

        if ($amount > $currentAmount) throw new \Exception('Невозможно списать средства, недостаточно средств');

        $this->amount -= $amount;
        return $this;
    }

    /**
     * Изменить баланс, нужно в тех слечиях если у нас есть уже готовый баланс
     * @param float $amount Сумма
     * @return $this
     */
    public function set(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Получить текуший баланс
     * @return float Сумма
     */
    public function get(): float
    {
        return $this->amount;
    }
}
