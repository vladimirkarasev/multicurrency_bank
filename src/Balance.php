<?php

namespace MultiCurrency\Bank;

class Balance
{

    public function __construct(
        public float $amount = 0
    )
    {

    }

    /**
     * Пополнить баланс
     * @param float $amount
     * @return $this
     */
    public function credit(float $amount): self
    {
        $this->amount += $amount;
        return $this;
    }

    /**
     * Списать с баланса
     * @param float $amount
     * @return $this
     * @throws \Exception
     */
    public function debit(float $amount): self
    {
        $currentAmount = $this->amount;

        if ($amount > $currentAmount ) throw new \Exception('Невозможно списать средства, недостаточно средств');

        $this->amount -= $amount;
        return $this;
    }

    /**
     * Получить текуший баланс
     * @return float
     */
    public function get(): float
    {
        return $this->amount;
    }

    /**
     * Получить текуший баланс
     * todo может надо будет убрать
     * @return string
     */
    public function __toString(): string
    {
        return $this->amount;
    }
}
