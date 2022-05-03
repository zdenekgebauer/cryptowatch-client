<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class PairsTest extends Unit
{
    protected UnitTester $tester;

    public function testGetPairs(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => file_get_contents(codecept_data_dir('pairs.json')),
                    'httpCode' => 200,
                    'error' => '',
                    'errorNo' => 0,
                ];
            }
        };
        $response = $client->getPairs();
        $pairs = $response->getPairs();
        $this->assertCount(12426, $pairs);
        $this->assertEquals(185927, $pairs[0]->id);
        $this->assertEquals(185262, $pairs[12425]->id);
        $this->assertNotEmpty($response->getCursor());
        $this->assertFalse($response->hasMore());
    }

    public function testGetPair(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => file_get_contents(codecept_data_dir('btcusdt.json')),
                    'httpCode' => 200,
                    'error' => '',
                    'errorNo' => 0,
                ];
            }
        };
        $pair = $client->getPair(Symbols::PAIR_BTCUSDT);
        $this->assertEquals(231, $pair->id);
        $this->assertEquals('btcusdt', $pair->symbol);
        $this->assertEquals('btc', $pair->baseAsset->symbol);
        $this->assertEquals('usdt', $pair->quoteAsset->symbol);
    }
}
