<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class AssetsTest extends Unit
{
    protected UnitTester $tester;

    public function testGetAssets(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => file_get_contents(codecept_data_dir('assets.json')),
                    'httpCode' => 200,
                    'error' => '',
                    'errorNo' => 0,
                ];
            }
        };
        $response = $client->getAssets();
        $assets = $response->getAssets();
        $this->assertCount(2720, $assets);
        $this->assertEquals(7900, $assets[0]->id);
        $this->assertEquals(5659, $assets[2719]->id);
        $this->assertNotEmpty($response->getCursor());
        $this->assertFalse($response->hasMore());
    }

    public function testGetAsset(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => file_get_contents(codecept_data_dir('btc.json')),
                    'httpCode' => 200,
                    'error' => '',
                    'errorNo' => 0,
                ];
            }
        };
        $asset = $client->getAsset(Symbols::ASSET_BTC);
        $this->assertEquals(60, $asset->id);
        $this->assertEquals('btc', $asset->symbol);
        $this->assertEquals('Bitcoin', $asset->name);
        $this->assertFalse($asset->fiat);
    }
}
