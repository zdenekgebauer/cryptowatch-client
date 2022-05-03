<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class ExchangeRequestTest extends Unit
{
    protected UnitTester $tester;

    public function testGetUri(): void
    {
        $request = new ExchangeRequest(Symbols::EXCHANGE_BINANCE);
        $this->tester->assertEquals('exchanges/binance', $request->getUri());
    }
}
