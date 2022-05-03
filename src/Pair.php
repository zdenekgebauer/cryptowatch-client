<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class Pair
{
    public function __construct(
        public int $id,
        public string $symbol,
        public Asset $baseAsset,
        public Asset $quoteAsset
    ) {
    }
}
