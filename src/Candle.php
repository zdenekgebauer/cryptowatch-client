<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

class Candle
{
    public function __construct(
        public int $closeTime,
        public float $openPrice,
        public float $highPrice,
        public float $lowPrice,
        public float $closePrice,
        public float $volume,
        public float $quoteVolume
    ) {
    }
}
