<?php

namespace AdrianMejias\SslLabs;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

/**
 * SSL Labs Wrapper
 *
 * @package AdrianMejias\SslLabs
 */
class SslLabsWrapper implements SslLabsContract
{
    /**
     * @inheritDoc
     */
    public function getRootCertsRaw(?int $trustStore = null)
    {
        return $this->request('/getRootCertsRaw', [
            'trustStore' => $trustStore,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getStatusCodes()
    {
        return $this->request('/getStatusCodes');
    }

    /**
     * @inheritDoc
     */
    public function getEndpointData(
        string $host,
        ?string $s = null,
        bool $fromCache = false
    ) {
        return $this->request('/getEndpointData', [
            'host' => $host,
            's' => $s ?? gethostbyname($host),
            'fromCache' => $fromCache,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function analyzeCached(
        string $host,
        int $maxAge,
        bool $publish = false,
        bool $ignoreMismatch = false
    ) {
        return $this->analyze(
            $host,
            $maxAge,
            $publish,
            false,
            true,
            'done',
            $ignoreMismatch
        );
    }

    /**
     * @inheritDoc
     */
    public function analyze(
        string $host,
        ?int $maxAge = null,
        bool $publish = false,
        bool $startNew = false,
        bool $fromCache = false,
        ?string $all = null,
        bool $ignoreMismatch = false
    ) {
        return $this->request('/analyze', [
            'host' => $host,
            'maxAge' => $maxAge,
            'publish' => $publish,
            'startNew' => $startNew,
            'fromCache' => $fromCache,
            'all' => $all,
            'ignoreMismatch' => $ignoreMismatch,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function info()
    {
        return $this->request('/info');
    }

    /**
     * @inheritDoc
     */
    public function parseParams(array $params): array
    {
        return (new Collection($params))->map(function ($param) {
            if (is_bool($param)) {
                $param = $param === true ? 'on' : 'off';
            }

            return $param;
        })->toArray();
    }

    /**
     * @inheritDoc
     */
    public function request(string $uri = '/', array $params = [])
    {
        $baseUri = 'https://' . config('ssllabs.endpoint', 'api.ssllabs.com');
        $apiVersionPath = 'api/' . config('ssllabs.version', 'v3');
        $path = mb_strpos($uri, '/') !== false ?
            ltrim(rtrim($uri, '/'), '/') : $uri;
        $apiPath = $baseUri . '/' . $apiVersionPath . '/' . $path;
        $apiParams = count($params) > 0 ? $this->parseParams($params) : null;
        $response = Http::acceptJson()->get($apiPath, $apiParams)->throw(
            fn ($response, $e) => throw new SslLabsException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious(),
            )
        );

        if (mb_strpos($uri, 'getRootCertsRaw') !== false) {
            return $response->body();
        }

        return $response->json(null, []);
    }
}
