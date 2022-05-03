<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class AssetsRequestTest extends Unit
{
    protected UnitTester $tester;

    public function testGetUri(): void
    {
        $request = new AssetsRequest();
        $this->tester->assertEquals('assets', $request->getUri());

        $request = new AssetsRequest('eyJsYXN0SUQiOjUwM30K', 1000);
        $this->tester->assertEquals('assets?cursor=eyJsYXN0SUQiOjUwM30K&limit=1000', $request->getUri());
    }
}
