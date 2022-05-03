<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class AssetRequest extends Request
{
    public function __construct(private string $assetSymbol)
    {
    }

    public function getUri(): string
    {
        return 'assets/' . $this->assetSymbol;
    }
}
