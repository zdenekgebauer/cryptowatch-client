<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class ExchangesRequest extends Request
{
    public function __construct()
    {
    }

    public function getUri(): string
    {
        return 'exchanges';
    }
}
