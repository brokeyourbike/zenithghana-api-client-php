# zenithghana-api-client-php

[![Latest Stable Version](https://img.shields.io/github/v/release/brokeyourbike/zenithghana-api-client-php)](https://github.com/brokeyourbike/zenithghana-api-client-php/releases)
[![Total Downloads](https://poser.pugx.org/brokeyourbike/zenithghana-api-client/downloads)](https://packagist.org/packages/brokeyourbike/zenithghana-api-client)

PixPayment API Client for PHP

## ZenithGhana

```bash
composer require brokeyourbike/zenithghana-api-client
```

## Usage

```php
use BrokeYourBike\ZenithGhana\Client;
use BrokeYourBike\ZenithGhana\Interfaces\ConfigInterface;

assert($config instanceof ConfigInterface);
assert($httpClient instanceof \GuzzleHttp\ClientInterface);

$apiClient = new Client($config, $httpClient);
$apiClient->status('reference');
```

## Authors
- [Ivan Stasiuk](https://github.com/brokeyourbike) | [Twitter](https://twitter.com/brokeyourbike) | [LinkedIn](https://www.linkedin.com/in/brokeyourbike) | [stasi.uk](https://stasi.uk)

## License
[BSD-3-Clause License](https://github.com/brokeyourbike/zenithghana-api-client-php/blob/main/LICENSE)
