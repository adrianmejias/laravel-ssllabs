<?php

namespace AdrianMejias\SslLabs\Tests\Unit;

use AdrianMejias\SslLabs\SslLabsFacade;

it('should handle mock getGrades', function () {
    SslLabsFacade::shouldReceive('getGrades')->once()
        ->andReturn(['A+', 'A-', 'A', 'B', 'C', 'D', 'E', 'F', 'T', 'M']);

    $result = SslLabsFacade::getGrades();
    expect($result)->toBeArray()
        ->toEqual(['A+', 'A-', 'A', 'B', 'C', 'D', 'E', 'F', 'T', 'M']);
});

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

it('should handle mock isMinGrade', function () {
    SslLabsFacade::shouldReceive('isMinGrade')->once()
        ->with(
            'www.ssllabs.com',
            'A+'
        )->andReturn(true);

    $result = SslLabsFacade::isMinGrade(
        'www.ssllabs.com',
        'A+'
    );
    expect($result)->toBeBool()->toBeTrue();
});

it('should handle mock info', function () {
    SslLabsFacade::shouldReceive('info')->once()->andReturn([]);

    $result = SslLabsFacade::info();
    expect($result)->toBeArray();
});
