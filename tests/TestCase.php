<?php

namespace AdrianMejias\SslLabs\Tests;

use AdrianMejias\SslLabs\SslLabsFacade;
use AdrianMejias\SslLabs\SslLabsServiceProvider;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as BaseTestCase;

/** @inheritDoc */
class TestCase extends BaseTestCase
{
    /** @inheritDoc */
    protected $loadEnvironmentVariables = true;

    /** @inheritDoc */
    protected function getPackageProviders($app): array
    {
        return [
            SslLabsServiceProvider::class,
        ];
    }

    /** @inheritDoc */
    protected function getPackageAliases($app): array
    {
        return [
            'SslLabs' => SslLabsFacade::class,
            'Http' => Http::class,
        ];
    }

    /** @inheritDoc */
    public function ignorePackageDiscoveriesFrom(): array
    {
        return [];
    }
}
