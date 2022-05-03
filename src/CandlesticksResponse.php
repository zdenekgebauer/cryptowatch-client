<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use InvalidArgumentException;

class CandlesticksResponse extends Response
{
    /**
     * @return array<Candle>
     */
    public function getCandles(string $period): array
    {
        if (!property_exists($this->json->result, $period)) {
            throw new InvalidArgumentException('Period ' . $period . ' not found');
        }
        $candles = [];
        foreach ($this->json->result->{$period} as $json) {
            $candles[] = new Candle(...$json);
        }
        return $candles;
    }
}
