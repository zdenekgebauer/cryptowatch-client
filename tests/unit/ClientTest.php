<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use Codeception\Test\Unit;
use UnitTester;

class ClientTest extends Unit
{
    protected UnitTester $tester;

    public function testCurlFailed(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => false,
                    'httpCode' => 500,
                    'error' => 'cannot resolve host',
                    'errorNo' => 6,
                ];
            }
        };
        $this->tester->expectThrowable(new Exception('cannot resolve host', 6), static function () use ($client) {
            $client->getPrice('binance', 'btceur');
        });
    }

    public function testErrorResponse(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => file_get_contents(codecept_data_dir('error.json')),
                    'httpCode' => 404,
                    'error' => '',
                    'errorNo' => 0,
                ];
            }
        };
        $this->tester->expectThrowable(new Exception('Exchange not found', 404), static function () use ($client) {
            $client->getPrice('invalid', 'btceur');
        });
    }

    public function testUnexpectedResponse(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => '{}',
                    'httpCode' => 200,
                    'error' => '',
                    'errorNo' => 0,
                ];
            }
        };
        $this->tester->expectThrowable(new Exception('Unexpected JSON response from API', 200), static function () use ($client) {
            $client->getPrice('binance', 'btceur');
        });
    }

    public function testInvalidResponse(): void
    {
        $client = new class() extends Client {
            protected function curlExec(Request $request): array
            {
                return [
                    'result' => '{',
                    'httpCode' => 500,
                    'error' => '',
                    'errorNo' => 0,
                ];
            }
        };
        $this->tester->expectThrowable(new Exception('JSON parse: Syntax error', 4), static function () use ($client) {
            $client->getPrice('binance', 'btceur');
        });
    }
}
