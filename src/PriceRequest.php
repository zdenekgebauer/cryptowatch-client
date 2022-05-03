<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class PriceRequest extends Request
{
    public function __construct(private string $exchange, private string $pair)
    {
    }

    final public function getUri(): string
    {
        return 'markets/' . $this->exchange . '/' . $this->pair . '/price';
    }
}
