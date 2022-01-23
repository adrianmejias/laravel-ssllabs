<?php

namespace AdrianMejias\SslLabs\Tests\Unit;

use AdrianMejias\SslLabs\SslLabsFacade;

it('should handle mock parseParams', function () {
    $params = [
        'foo' => 'bar',
        'bar' => true,
    ];
    SslLabsFacade::shouldReceive('parseParams')->once()
        ->with($params)->andReturn([
            'foo' => 'bar',
            'bar' => 'on',
        ]);

    $result = SslLabsFacade::parseParams($params);
    expect($result)->toBeArray()
        ->foo->toBeString()
        ->foo->toEqual('bar')
        ->bar->toBeString()
        ->bar->toEqual('on');
});

it('should handle mock request', function () {
    SslLabsFacade::shouldReceive('request')->once()
        ->with('/info')->andReturn([]);

    $result = SslLabsFacade::request('/info');
    expect($result)->toBeArray();
});

it('should handle mock getRootCertsRaw', function () {
    SslLabsFacade::shouldReceive('getRootCertsRaw')->once()
        ->andReturn('AAA Certificate Services');

    $result = SslLabsFacade::getRootCertsRaw();
    expect($result)->toBeString()
        ->toContain('AAA Certificate Services');
});

it('should handle mock getStatusCodes', function () {
    SslLabsFacade::shouldReceive('getStatusCodes')->once()->andReturn([]);

    $result = SslLabsFacade::getStatusCodes();
    expect($result)->toBeArray();
});

it('should handle mock getEndpointData', function () {
    SslLabsFacade::shouldReceive('getEndpointData')->once()
        ->with(
            'www.ssllabs.com',
            '64.41.200.100',
            true
        )->andReturn([]);

    $result = SslLabsFacade::getEndpointData(
        'www.ssllabs.com',
        '64.41.200.100',
        true
    );
    expect($result)->toBeArray();
});

it('should handle mock getEndpointData with getipbyhostname', function () {
    SslLabsFacade::shouldReceive('getEndpointData')->once()
        ->with(
            'www.ssllabs.com',
            null,
            true
        )->andReturn([]);

    $result = SslLabsFacade::getEndpointData(
        'www.ssllabs.com',
        null,
        true
    );
    expect($result)->toBeArray();
});

it('should handle mock analyze', function () {
    SslLabsFacade::shouldReceive('analyze')->once()
        ->with(
            'www.ssllabs.com',
            null,
            false,
            false,
            true,
            null,
            false
        )->andReturn([]);

    $result = SslLabsFacade::analyze(
        'www.ssllabs.com',
        null,
        false,
        false,
        true,
        null,
        false
    );
    expect($result)->toBeArray();
});

it('should handle mock analyzeCached', function () {
    SslLabsFacade::shouldReceive('analyzeCached')->once()
        ->with(
            'www.ssllabs.com',
            1,
        )->andReturn([]);

    $result = SslLabsFacade::analyzeCached(
        'www.ssllabs.com',
        1,
    );
    expect($result)->toBeArray();
});

it('should handle mock info', function () {
    SslLabsFacade::shouldReceive('info')->once()->andReturn([]);

    $result = SslLabsFacade::info();
    expect($result)->toBeArray();
});
