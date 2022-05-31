<?php

declare(strict_types=1);

namespace ZdenekGebauer\CryptowatchClient;

use DateTimeInterface;
use JsonException;
use stdClass;

use function is_string;
use function strlen;

class Client
{
    private const ENDPOINT = 'https://api.cryptowat.ch/';

    public function __construct(private string $apiKey = '')
    {
    }

    public function getAsset(string $assetSymbol): Asset
    {
        $request = new AssetRequest($assetSymbol);
        return (new AssetResponse($this->sendRequest($request)))->getAsset();
    }

    public function getAssets(string $cursor = null, int $limit = null): AssetsResponse
    {
        $request = new AssetsRequest($cursor, $limit);
        return new AssetsResponse($this->sendRequest($request));
    }

    /**
     * @param array<string> $periods see CandlePeriods::* constants
     */
    public function getCandlesticks(
        string $exchange,
        string $pair,
        array $periods = [],
        ?DateTimeInterface $start = null,
        ?DateTimeInterface $end = null
    ): CandlesticksResponse {
        $request = new CandlesticksRequest($exchange, $pair, $periods, $start, $end);
        $json = $this->sendRequest($request);
        return new CandlesticksResponse($json);
    }

    public function getPrice(string $exchange, string $pair): float
    {
        $request = new PriceRequest($exchange, $pair);
        return (new PriceResponse($this->sendRequest($request)))->getPrice();
    }

    public function getExchange(string $exchangeSymbol): Exchange
    {
        $request = new ExchangeRequest($exchangeSymbol);
        return (new ExchangeResponse($this->sendRequest($request)))->getExchange();
    }

    /**
     * @return array<Exchange>
     */
    public function getExchanges(): array
    {
        $request = new ExchangesRequest();
        return (new ExchangesResponse($this->sendRequest($request)))->getExchanges();
    }

    public function getPair(string $pairSymbol): Pair
    {
        $request = new PairRequest($pairSymbol);
        return (new PairResponse($this->sendRequest($request)))->getPair();
    }

    public function getPairs(string $cursor = null, int $limit = null): PairsResponse
    {
        $request = new PairsRequest($cursor, $limit);
        return new PairsResponse($this->sendRequest($request));
    }

    /**
     * @return array{result: string|bool, httpCode:int, error:string, errorNo:int}
     */
    protected function curlExec(Request $request): array
    {
        $url = self::ENDPOINT . $request->getUri();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        if ($this->apiKey !== '') {
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-CW-API-Key: ' . $this->apiKey]);
        }
        $headerSize = 0;
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, static function ($ch, $header) use (&$headerSize) {
            $lineLength = strlen($header);
            $headerSize += $lineLength;
            return $lineLength;
        });

        $result = curl_exec($ch);
        $error = curl_error($ch);
        $errorNo = curl_errno($ch);
        $httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (is_string($result)) {
            $result = substr($result, $headerSize);
        }
        return compact('result', 'httpCode', 'error', 'errorNo');
    }

    /**
     * @phpstan-return stdClass
     */
    private function sendRequest(Request $request): stdClass
    {
        $apiResponse = $this->curlExec($request);
        if ($apiResponse['result'] === false) {
            throw new Exception($apiResponse['error'], $apiResponse['errorNo']);
        }

        try {
            /** @phpstan-var stdClass $json */
            $json = json_decode((string)$apiResponse['result'], false, 512, JSON_THROW_ON_ERROR | JSON_FORCE_OBJECT);
        } catch (JsonException $exception) {
            throw new Exception('JSON parse: ' . $exception->getMessage(), $exception->getCode(), $exception);
        }
        if (property_exists($json, 'result')) {
            return $json;
        }

        if (property_exists($json, 'error')) {
            throw new Exception($json->error, $apiResponse['httpCode']);
        }
        throw new Exception('Unexpected JSON response from API', $apiResponse['httpCode']);
    }
}
