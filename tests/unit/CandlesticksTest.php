<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class CandlesticksTest extends Unit
{
    protected UnitTester $tester;

    public function testGetCandlesticks(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => file_get_contents(codecept_data_dir('ohlc.json')),
                    'httpCode' => 200,
                    'error' => '',
                    'errorNo' => 0,
                ];
            }
        };
        $response = $client->getCandlesticks(Symbols::EXCHANGE_BINANCE, Symbols::PAIR_BTCUSDT);
        $candles = $response->getCandles(CandlePeriods::FOUR_HOURS);

        $this->assertCount(1000, $candles);

        $this->assertEquals(1637193600, $candles[0]->closeTime);
        $this->assertEquals(60212.48, $candles[0]->openPrice);
        $this->assertEquals(60575.08, $candles[0]->highPrice);
        $this->assertEquals( 59620.66, $candles[0]->lowPrice);
        $this->assertEquals(60344.87, $candles[0]->closePrice);
        $this->assertEquals(4758.80394, $candles[0]->volume);
        $this->assertEquals(285944790.6080839, $candles[0]->quoteVolume);

        $this->assertEquals(1651579200, $candles[999]->closeTime);

        $this->tester->expectThrowable(new \InvalidArgumentException('Period invalid not found'), static function() use($response) {
            $response->getCandles('invalid');
        });
    }
}
