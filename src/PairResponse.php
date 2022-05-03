<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class PairResponse extends Response
{
    public function getPair(): Pair
    {
        $baseAsset = new Asset(
            $this->json->result->base->id,
            $this->json->result->base->symbol,
            $this->json->result->base->name,
            $this->json->result->base->fiat
        );
        $quoteAsset = new Asset(
            $this->json->result->quote->id,
            $this->json->result->quote->symbol,
            $this->json->result->quote->name,
            $this->json->result->quote->fiat
        );
        return new Pair($this->json->result->id, $this->json->result->symbol, $baseAsset, $quoteAsset);
    }
}
