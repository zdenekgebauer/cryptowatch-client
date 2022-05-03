<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class ExchangeRequest extends Request
{
    public function __construct(private string $exchangeSymbol)
    {
    }

    public function getUri(): string
    {
        return 'exchanges/' . $this->exchangeSymbol;
    }
}
