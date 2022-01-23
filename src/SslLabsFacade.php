<?php

namespace AdrianMejias\SslLabs;

use Illuminate\Support\Facades\Facade;

/**
 * SSL Labs Facade
 *
 * @package AdrianMejias\SslLabs
 * @method static mixed getRootCertsRaw(?int $trustStore = null)
 * @method static mixed getStatusCodes()
 * @method static mixed getEndpointData(string $host, string $s, bool $fromCache = false)
 * @method static mixed analyzeCached(string $host, int $maxAge, bool $publish = false, bool $ignoreMismatch = false)
 * @method static mixed analyze(string $host, ?int $maxAge = null, bool $publish = false, bool $startNew = false, bool $fromCache = false, ?string $all = null, bool $ignoreMismatch = false)
 * @method static mixed info()
 * @method static mixed parseParams(array $params)
 * @method static mixed request(string $uri = '/', array $params = [])
 */
class SslLabsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ssllabs';
    }
}
