# Laravel SSL Labs Quality Checker

[![security](https://github.com/adrianmejias/laravel-ssllabs/actions/workflows/security.yml/badge.svg)](https://github.com/adrianmejias/laravel-ssllabs/actions/workflows/security.yml) [![tests](https://github.com/adrianmejias/laravel-ssllabs/actions/workflows/tests.yml/badge.svg)](https://github.com/adrianmejias/laravel-ssllabs/actions/workflows/tests.yml) [![PHPStan](https://github.com/adrianmejias/laravel-ssllabs/actions/workflows/phpstan.yml/badge.svg)](https://github.com/adrianmejias/laravel-ssllabs/actions/workflows/phpstan.yml) [![PHP CS Fixer](https://github.com/adrianmejias/laravel-ssllabs/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/adrianmejias/laravel-ssllabs/actions/workflows/php-cs-fixer.yml) [![StyleCI](https://github.styleci.io/repos/446770602/shield?branch=main)](https://github.styleci.io/repos/446770602?branch=main) [![Build Status](https://travis-ci.com/adrianmejias/laravel-ssllabs.svg?branch=main)](https://travis-ci.com/adrianmejias/laravel-ssllabs) [![codecov](https://codecov.io/gh/adrianmejias/laravel-ssllabs/branch/main/graph/badge.svg?token=7TCWYB1YV6)](https://codecov.io/gh/adrianmejias/laravel-ssllabs) ![Downloads](https://img.shields.io/packagist/dt/adrianmejias/laravel-ssllabs) ![Packagist](https://img.shields.io/packagist/v/adrianmejias/laravel-ssllabs) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT) ![Liberapay](https://img.shields.io/liberapay/patrons/adrianmejias.svg?logo=liberapay)

[SSL Labs](https://www.ssllabs.com/projects/ssllabs-apis/) Quality Checker for the [Laravel Framework](https://laravel.com/).

## Installation

This version supports PHP 8.0. You can install the package via composer:

`composer require adrianmejias/laravel-ssllabs`

To create the `config/ssllabs.php` configuration file:

`php artisan vendor:publish --tag=ssllabs`

## Usage

### Example

```php
<?php

use AdrianMejias\SslLabs\SslLabsFacade as SslLabs;
// or use SslLabs;

$info = SslLabs::info();
```

Expected Output:
```php
$info = [
    'engineVersion' => '2.1.10',
    'criteriaVersion' => '2009q',
    'maxAssessments' => 25,
    'currentAssessments' => 0,
    'newAssessmentCoolOff' => 1000,
    'messages' => [
        'This assessment service is provided free of charge by Qualys SSL Labs, subject to our terms and conditions: https://www.ssllabs.com/about/terms.html',
    ],
];
```

### Api Requests

- `getRootCertsRaw(?int $trustStore = null)` Retrieve root certificates.
- `getStatusCodes()` Retrieve known status codes.
- `getEndpointData(string $host, string $s, bool $fromCache = false)` Retrieve detailed endpoint information.
- `analyzeCached(string $host, int $maxAge, bool $publish = false, bool $ignoreMismatch = false)` Invoke assessment and check progress from cache.
- `analyze(string $host, ?int $maxAge = null, bool $publish = false, bool $startNew = false, bool $fromCache = false, ?string $all = null, bool $ignoreMismatch = false)` Invoke assessment and check progress.
- `info()` Check SSL Labs availability.

## Testing

`composer test`

## Todo

- [x] Add to packagist repo
- [x] Add unit tests
- [x] Add documentation for open source contributations
- [x] Add GitHub Action for unit tests
- [ ] Add more unit test coverages
- [ ] Add more documentation to README.md
- [ ] Add API listing to README.md

## Contributing

Thank you for considering contributing to Laravel SSL Labs! You can read the contribution guide [here](.github/CONTRIBUTING.md).

## Code of Conduct

In order to ensure that the community is welcoming to all, please review and abide by the [Code of Conduct](.github/CODE_OF_CONDUCT.md).

## Security Vulnerabilities

Please see the [security file](SECURITY.md) for more information.

## License

The MIT License (MIT). Please see the [license file](LICENSE.md) for more information.
