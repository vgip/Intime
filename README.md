# Intime API client

For connection to API Intime v3.x ([intime.ua](https://intime.ua))

### Capabilities
- extensive configuration and modification options;
- error validating in incoming data* or get raw data from API;
- set validation parameters for properties (overriding patterns and conditions in Singleton);
- converting key and value into a single format*;
- no dependency and framework;
- require php 7.2;
- strict type

> *Ready not for all methods, under construction.

## Installation

### Composer (recommended)

Use [Composer](https://getcomposer.org) to install this library from Packagist:
[`vgip/intime`](https://packagist.org/packages/vgip/intime)

Run the following command from your project directory to add the dependency:

```sh
composer require vgip/intime "~1.0"
```

Alternatively, add the dependency directly to your `composer.json` file:

```json
"require": {
    "vgip/intime": "~1.0"
}
```

The classes in the project are structured according to the
[PSR-4](http://www.php-fig.org/psr/psr-4/) standard, so you can also use your
own autoloader or require the needed files directly in your code.

## How to use

To use all the methods of the API, you must have a key. 
You can get it by registering on the site [intime.ua](https://intime.ua).
To access only directories, such as a directory of countries, districts, branches and some others 
you can use the "free" key "10000000000001234567".


```php
<?php

use Vgip\Intime\Api\Config AS IntimeApiConfig;
use Vgip\Intime\Api\ConfigDefault AS IntimeApiConfigDefault;
use Vgip\Intime\Api\Api AS IntimeApi;

$apiKey = '10000000000001234567';

/** Set default configuration */
$intimeApiConfigDefault = new IntimeApiConfigDefault();
$intimeApiConfigDefault->setDefaultConfig();
$intimeApiConfig        = new IntimeApiConfig($intimeApiConfigDefault);

/** Set configuration (rewrite defaults) */
$intimeApiConfig->setKey($apiKey);
$intimeApiConfig->setRestRequestType('POST');

/** Connect to API and get all district in region with id 2 */
$intimeApi              = new IntimeApi($intimeApiConfig);
$resultConnection       = $intimeApi->getLocalityByRegionId(20);

$availableResultVariant = [
    1 => 'Raw data as string',
    2 => 'Raw data as array',
    3 => 'Converted and validated data as array',
    4 => 'Converted and validated data as object',
];

/** Set the format and actions for the received data */
$resultVariant = 3;

/** Limitations - under construction 
 * 
 *      ResultConnection methods getAnswerArray() (3) and getAnswer() (4) are available only 
 *  for IntimeApi directories (methods):
 * 
 *  getBranch()
 *  getCountry()
 *  getDistrict()
 *  getLocality()
 *  getRegion()
 * and similar.
 */

if (1 === $resultVariant) {
    $dataRaw        = $resultConnection->getAnswerRaw();
    $resData = $dataRaw;
} elseif (2 === $resultVariant) {
    $dataArrayRaw   = $resultConnection->getAnswerArrayRaw();
    $resData = $dataArrayRaw;
} elseif (3 === $resultVariant) {
    $data           = $resultConnection->getAnswerArray();
    $resData = $data;
} elseif (4 === $resultVariant) {
    $dataObj        = $resultConnection->getAnswer();
    $resData = $dataObj;
}

/** Error view if present */
$error = $resultConnection->getError();
$errorCounter = $error->getErrorCounter();
if ($errorCounter > 0) {
    print_r($error->getErrorAll());
}

print_r($resData);

```


## Intime API documentation

### Client 
This project documentation: [github wiki](https://github.com/vgip/Intime/wiki)

### Server
Be careful - API server documentation v3.1 contains many errors: [server documentation](https://intime.ua/ru-api)


## Standards

Versioning: MAJOR.MINOR.PATCH version number format.

Codestyle: PSR12


## Contributing

Read [documentation](https://github.com/vgip/Intime/wiki), direct your [pull request](https://github.com/vgip/Intime/pulls) and [ask questions](https://github.com/vgip/Intime/issues).
