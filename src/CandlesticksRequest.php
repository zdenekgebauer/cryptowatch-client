<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use DateTimeInterface;

class CandlesticksRequest extends Request
{
    /**
     * @param array<string> $periods
     */
    public function __construct(
        private string $exchange,
        private string $pair,
        private array $periods = [],
        private ?DateTimeInterface $start = null,
        private ?DateTimeInterface $end = null
    ) {
    }

    public function getUri(): string
    {
        $uri = 'markets/' . $this->exchange . '/' . $this->pair . '/ohlc';
        $data = [];
        if ($this->start !== null) {
            $data['after'] = $this->start->getTimestamp();
        }
        if ($this->end !== null) {
            $data['before'] = $this->end->getTimestamp();
        }
        if (!empty($this->periods)) {
            $data['periods'] = implode(',', $this->periods);
        }
        if (!empty($data)) {
            $uri .= '?' . http_build_query($data);
        }
        return $uri;
    }
}
