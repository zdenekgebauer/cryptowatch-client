<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class PriceTest extends Unit
{
    protected UnitTester $tester;

    public function testPrice(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => file_get_contents(codecept_data_dir('price.json')),
                    'httpCode' => 200,
                    'error' => '',
                    'errorNo' => 0,
                ];
            }
        };
        $this->tester->assertEquals(37971.1, $client->getPrice('binance', 'btceur'));
    }
}
