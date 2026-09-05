# Growsurf PHP API library

The Growsurf PHP library provides convenient access to the Growsurf REST API from any PHP 8.1.0+ application.

It was originally generated with [Stainless](https://www.stainless.com/) and is now maintained by hand.

## Documentation

Read the [GrowSurf REST API reference](https://docs.growsurf.com/developer-tools/rest-api/api-reference).

## Installation

Install the package with Composer:

<!-- x-release-please-start-version -->

```sh
composer require growsurf/growsurf-php
```

<!-- x-release-please-end -->

## Usage

This library uses named parameters to specify optional arguments.
Parameters with a default value must be set by name.

```php
<?php

use Growsurf\Client;

$client = new Client(apiKey: getenv('GROWSURF_API_KEY') ?: 'My API Key');

$campaigns = $client->campaign->list();

var_dump($campaigns->campaigns);
```

### Value Objects

Use a static `with` constructor and named parameters to initialize value objects:

```php
<?php

use Growsurf\Campaign\CampaignCreateParams;

$params = CampaignCreateParams::with(
  type: 'REFERRAL',
  name: 'Middle Out Compression Campaign',
);
```

Builders are also available:

```php
<?php

use Growsurf\Campaign\CampaignCreateParams;

$params = (new CampaignCreateParams)
  ->withType('REFERRAL')
  ->withName('Middle Out Compression Campaign');
```

### Handling errors

When the library is unable to connect to the API, or if the API returns a non-success status code (i.e., 4xx or 5xx response), a subclass of `Growsurf\Core\Exceptions\APIException` will be thrown:

```php
<?php

use Growsurf\Core\Exceptions\APIConnectionException;
use Growsurf\Core\Exceptions\RateLimitException;
use Growsurf\Core\Exceptions\APIStatusException;

try {
  $campaigns = $client->campaign->list();
} catch (APIConnectionException $e) {
  echo "The server could not be reached", PHP_EOL;
  var_dump($e->getPrevious());
} catch (RateLimitException $e) {
  echo "A 429 status code was received; we should back off a bit.", PHP_EOL;
} catch (APIStatusException $e) {
  echo "Another non-200-range status code was received", PHP_EOL;
  echo $e->getMessage();
}
```

Error codes are as follows:

| Cause            | Error Type                     |
| ---------------- | ------------------------------ |
| HTTP 400         | `BadRequestException`          |
| HTTP 401         | `AuthenticationException`      |
| HTTP 403         | `PermissionDeniedException`    |
| HTTP 404         | `NotFoundException`            |
| HTTP 409         | `ConflictException`            |
| HTTP 422         | `UnprocessableEntityException` |
| HTTP 429         | `RateLimitException`           |
| HTTP >= 500      | `InternalServerException`      |
| Other HTTP error | `APIStatusException`           |
| Timeout          | `APITimeoutException`          |
| Network error    | `APIConnectionException`       |

### Retries

`GET` and `HEAD` requests are retried up to two times by default, with a short exponential backoff. API-key rotation is also retried because the SDK generates and reuses an `Idempotency-Key` for that request. Other `POST`, `PATCH`, and `DELETE` requests are not retried automatically.

For requests that are safe to retry, the SDK retries connection errors, timeouts, `408 Request Timeout`, `409 Conflict`, `429 Rate Limit`, and `5xx` responses.

You can use the `maxRetries` option to configure or disable this:

```php
<?php

use Growsurf\Client;

// Configure the default for all requests:
$client = new Client(requestOptions: ['maxRetries' => 0]);

// Or, configure per-request:
$result = $client->campaign->list(requestOptions: ['maxRetries' => 5]);
```

## Advanced concepts

### Making custom or undocumented requests

#### Undocumented properties

You can send undocumented parameters to any endpoint, and read undocumented response properties, like so:

Extra parameters override documented parameters with the same name.

```php
<?php

$campaigns = $client->campaign->list(
  requestOptions: [
    'extraQueryParams' => ['my_query_parameter' => 'value'],
    'extraBodyParams' => ['my_body_parameter' => 'value'],
    'extraHeaders' => ['my-header' => 'value'],
  ],
);
```

#### Undocumented request params

To send an extra parameter explicitly, use `extraQueryParams`, `extraBodyParams`, or `extraHeaders` in the `requestOptions` argument, as shown above.

#### Undocumented endpoints

To make requests to undocumented endpoints while retaining the benefit of auth, retries, and so on, you can make requests using `client.request`, like so:

```php
<?php

$response = $client->request(
  method: "post",
  path: '/undocumented/endpoint',
  query: ['dog' => 'woof'],
  headers: ['useful-header' => 'interesting-value'],
  body: ['hello' => 'world']
);
```

## Versioning

This package follows [SemVer](https://semver.org/spec/v2.0.0.html) conventions. As the library is in initial development and has a major version of `0`, APIs may change at any time.

This package considers improvements to the (non-runtime) PHPDoc type definitions to be non-breaking changes.

## Requirements

PHP 8.1.0 or higher.

## Contributing

See [the contributing documentation](https://github.com/growsurf/growsurf-php/tree/main/CONTRIBUTING.md).
