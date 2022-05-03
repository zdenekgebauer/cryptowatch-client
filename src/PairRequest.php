<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class PairRequest extends Request
{
    public function __construct(private string $pairSymbol)
    {
    }

    public function getUri(): string
    {
        return 'pairs/' . $this->pairSymbol;
    }
}
