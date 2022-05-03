<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class AssetResponse extends Response
{
    public function getAsset(): Asset
    {
        return new Asset(
            $this->json->result->id,
            $this->json->result->symbol,
            $this->json->result->name,
            $this->json->result->fiat
        );
    }
}
