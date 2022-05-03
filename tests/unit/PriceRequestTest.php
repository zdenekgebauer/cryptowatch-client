<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class PriceRequestTest extends Unit
{
    protected UnitTester $tester;

    public function testGetUri(): void
    {
        $request = new PriceRequest(Symbols::EXCHANGE_BINANCE, Symbols::PAIR_BTCUSDT);
        $this->tester->assertEquals('markets/binance/btcusdt/price', $request->getUri());
    }
}
