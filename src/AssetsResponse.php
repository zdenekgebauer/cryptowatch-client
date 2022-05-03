<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class AssetsResponse extends PaginatedResponse
{
    /**
     * @return array<Asset>
     */
    public function getAssets(): array
    {
        $assets = [];
        foreach ($this->json->result as $json) {
            $assets[] = new Asset($json->id, $json->symbol, $json->name, $json->fiat);
        }
        return $assets;
    }
}
