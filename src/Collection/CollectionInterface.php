<?php

namespace MultiCurrency\Collection;

use Closure;

interface CollectionInterface
{
    public function add(string $key, $object);

    public function has(string $key): bool;

    public function remove(string $key);

    public function get(string $key);
}