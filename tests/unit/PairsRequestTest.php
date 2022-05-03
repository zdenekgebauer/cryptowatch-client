<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class PairsRequestTest extends Unit
{
    protected UnitTester $tester;

    public function testGetUri(): void
    {
        $request = new PairsRequest();
        $this->tester->assertEquals('pairs', $request->getUri());

        $request = new PairsRequest('eyJsYXN0SUQiOjUwM30K', 1000);
        $this->tester->assertEquals('pairs?cursor=eyJsYXN0SUQiOjUwM30K&limit=1000', $request->getUri());
    }
}
