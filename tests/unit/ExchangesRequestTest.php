<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class ExchangesRequestTest extends Unit
{
    protected UnitTester $tester;

    public function testGetUri(): void
    {
        $request = new ExchangesRequest();
        $this->tester->assertEquals('exchanges', $request->getUri());
    }
}
