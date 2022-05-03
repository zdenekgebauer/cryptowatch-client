<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class PairRequestTest extends Unit
{
    protected UnitTester $tester;

    public function testGetUri(): void
    {
        $request = new PairRequest('btceur');
        $this->tester->assertEquals('pairs/btceur', $request->getUri());
    }
}
