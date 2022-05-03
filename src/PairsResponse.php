<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class PairsResponse extends PaginatedResponse
{
    /**
     * @return array<Pair>
     */
    public function getPairs(): array
    {
        $pairs = [];
        foreach ($this->json->result as $json) {
            $baseAsset = new Asset($json->base->id, $json->base->symbol, $json->base->name, $json->base->fiat);
            $quoteAsset = new Asset($json->quote->id, $json->quote->symbol, $json->quote->name, $json->quote->fiat);
            $pairs[] = new Pair($json->id, $json->symbol, $baseAsset, $quoteAsset);
        }
        return $pairs;
    }
}
