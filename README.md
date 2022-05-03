# Cryptowatch HTTP client 

![](https://github.com/zdenekgebauer/cryptowatch-client/workflows/build/badge.svg)

Client for REST API https://cryptowat.ch/
Official API documentation: https://docs.cryptowat.ch/rest-api/

## Installation

`composer require zdenekgebauer/cryptowatch-client`

## Usage

```php
use \ZdenekGebauer\CryptowatchClient\Client;
use \ZdenekGebauer\CryptowatchClient\Symbols;
use \ZdenekGebauer\CryptowatchClient\CandlePeriods;

// free/anonymous limited access  
$client = new Client(); 
// or access with key
// $client = new Client('my key');

// retrieve current price
try { 
  var_dump($client->getPrice('kraken', 'btcusd')); // see Symbols::* konstants
} catch (\ZdenekGebauer\CryptowatchClient\Exception) {
 
}

// retrieve supported exchanges
var_dump($client->getExchanges());
// retrieve exchange detail
var_dump($client->getExchange(Symbols::EXCHANGE_KRAKEN));

// retrieve asset detail
var_dump($client->getAsset(Symbols::ASSET_BTC));

// retrieve pair
var_dump($client->getPair(Symbols::PAIR_BTCUSDT));

// retrieve candlesticks data (OLHC = Open Low High Close prices)
$response = $client->getCandlesticks(Symbols::EXCHANGE_BINANCE, Symbols::PAIR_BTCUSDT);
$candles = $response->getCandles(CandlePeriods::FOUR_HOURS);

foreach ($candles as $candle) {
    var_dump($candle->closeTime);
    var_dump($candle->openPrice);
    var_dump($candle->highPrice);
    var_dump($candle->lowPrice);
    var_dump($candle->volume);
    var_dump($candle->quoteVolume);
}
```

## Known issues
- requests for trades and order books are not (yet?) implemented
- some data from API are omitted, ie allowance, routes 

## Licence
Released under the [WTFPL license](copying.txt) http://www.wtfpl.net/about/.
