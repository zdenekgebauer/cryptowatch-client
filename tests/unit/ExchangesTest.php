<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class ExchangesTest extends Unit
{
    protected UnitTester $tester;

    public function testGetAssets(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => file_get_contents(codecept_data_dir('exchanges.json')),
                    'httpCode' => 200,
                    'error' => '',
                    'errorNo' => 0,
                ];
            }
        };
        $exchanges = $client->getExchanges();
        $this->assertCount(45, $exchanges);
        $this->assertEquals(16, $exchanges[0]->id);
        $this->assertEquals(97, $exchanges[44]->id);
    }

    public function testGetExchange(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => file_get_contents(codecept_data_dir('binance.json')),
                    'httpCode' => 200,
                    'error' => '',
                    'errorNo' => 0,
                ];
            }
        };
        $exchange = $client->getExchange(Symbols::EXCHANGE_BINANCE);
        $this->assertEquals(27, $exchange->id);
        $this->assertEquals('binance', $exchange->symbol);
        $this->assertEquals('Binance', $exchange->name);
        $this->assertTrue($exchange->active);
    }
}
