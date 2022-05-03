<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class Exchange
{
    public function __construct(public int $id, public string $symbol, public string $name, public bool $active)
    {
    }
}
