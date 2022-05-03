<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use DateTimeImmutable;
use UnitTester;

class CandlesticksRequestTest extends Unit
{
    protected UnitTester $tester;

    public function testGetUri(): void
    {
        $request = new CandlesticksRequest(Symbols::EXCHANGE_KRAKEN, Symbols::PAIR_BTCUSD);
        $this->tester->assertEquals('markets/kraken/btcusd/ohlc', $request->getUri());

        $start = new DateTimeImmutable('-1 week');
        $end = new DateTimeImmutable('-1 day');
        $request = new CandlesticksRequest(
            Symbols::EXCHANGE_BINANCE,
            Symbols::PAIR_BTCUSDT,
            [CandlePeriods::ONE_DAY, CandlePeriods::ONE_HOUR],
            $start,
            $end
        );
        $this->tester->assertEquals(
            'markets/binance/btcusdt/ohlc?after=' . $start->getTimestamp() . '&before=' . $end->getTimestamp(
            ) . '&periods=86400%2C3600',
            $request->getUri()
        );
    }
}
