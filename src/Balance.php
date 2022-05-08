<?php

namespace MultiCurrency\Bank;

class Balance
{

    public function __construct(
        public float $amount = 0
    )
    {

    }

    public function add(float $amount): self
    {
        $this->amount = $amount;
        return  $this;
    }


    public function get(): float
    {
        return $this->amount;
    }

    public function __toString(): string
    {
        return $this->amount;
    }
}
