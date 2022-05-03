<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class AssetRequestTest extends Unit
{
    protected UnitTester $tester;

    public function testGetUri(): void
    {
        $request = new AssetRequest(Symbols::ASSET_BTC);
        $this->tester->assertEquals('assets/btc', $request->getUri());
    }
}
