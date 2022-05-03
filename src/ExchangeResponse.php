<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class ExchangeResponse extends Response
{
    public function getExchange(): Exchange
    {
        return new Exchange(
            $this->json->result->id,
            $this->json->result->symbol,
            $this->json->result->name,
            $this->json->result->active
        );
    }
}
