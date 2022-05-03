<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class ExchangesResponse extends Response
{
    /**
     * @return array<Exchange>
     */
    public function getExchanges(): array
    {
        $exchanges = [];
        foreach ($this->json->result as $json) {
            $exchanges[] = new Exchange($json->id, $json->symbol, $json->name, $json->active);
        }
        return $exchanges;
    }
}
