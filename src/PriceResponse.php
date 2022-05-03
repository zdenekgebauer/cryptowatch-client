<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class PriceResponse extends Response
{
    public function getPrice(): float
    {
        return $this->json->result->price;
    }
}
