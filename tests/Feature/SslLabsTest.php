<?php

namespace AdrianMejias\SslLabs\Tests\Feature;

use AdrianMejias\SslLabs\SslLabsException;
use AdrianMejias\SslLabs\SslLabsFacade;

it('should handle exception', function () {
    throw new SslLabsException('Something happened.');
})->throws(SslLabsException::class);

it('should handle request exception', function () {
    SslLabsFacade::request('/noexist');
})->throws(SslLabsException::class);

it('should handle getGrades')->expect(fn () => SslLabsFacade::getGrades())
    ->toBeArray()
    ->toEqual(['A+', 'A-', 'A', 'B', 'C', 'D', 'E', 'F', 'T', 'M']);

it('should handle parseParams')->expect(fn () => SslLabsFacade::parseParams([
    'foo' => 'bar',
    'bar' => true,
]))
    ->toBeArray()
    ->foo->toBeString()
    ->foo->toEqual('bar')
    ->bar->toBeString()
    ->bar->toEqual('on');

it('should handle request')->expect(fn () => SslLabsFacade::request('/info'))
    ->toBeArray()
    ->toHaveKeys([
        'engineVersion',
        'messages',
    ])
    ->engineVersion->toBeString()
    ->messages->toBeArray();

it('should handle getRootCertsRaw')->expect(fn () => SslLabsFacade::getRootCertsRaw())
    ->toBeString()
    ->toContain('AAA Certificate Services');

it('should handle getStatusCodes')->expect(fn () => SslLabsFacade::getStatusCodes())
    ->toBeArray()
    ->statusDetails->toBeArray()
    ->statusDetails->toHaveKey('TESTING_STRICT_RI')
    ->statusDetails
    ->TESTING_STRICT_RI->toBeString();

it('should handle getEndpointData')->expect(fn () => SslLabsFacade::getEndpointData(
    'www.ssllabs.com',
    '64.41.200.100',
    true
))
    ->toBeArray()
    ->toHaveKeys([
        'ipAddress',
        'serverName',
        'statusMessage',
        'grade',
    ])
    ->ipAddress->toBeString()
    ->ipAddress->toEqual('64.41.200.100')
    ->serverName->toBeString()
    ->serverName->toEqual('www.ssllabs.com')
    ->statusMessage->toBeString()
    ->statusMessage->toEqual('Ready')
    ->grade->toBeString()
    ->grade->toEqual('A+');

it('should handle getEndpointData with getipbyhostname')
    ->expect(fn () => SslLabsFacade::getEndpointData(
        'www.ssllabs.com',
        null,
        true
    ))
    ->toBeArray()
    ->toHaveKeys([
        'ipAddress',
        'serverName',
        'statusMessage',
        'grade',
    ])
    ->ipAddress->toBeString()
    ->ipAddress->toEqual('64.41.200.100')
    ->serverName->toBeString()
    ->serverName->toEqual('www.ssllabs.com')
    ->statusMessage->toBeString()
    ->statusMessage->toEqual('Ready')
    ->grade->toBeString()
    ->grade->toEqual('A+');

it('should handle isMinGrade')->expect(fn () => SslLabsFacade::isMinGrade(
    'www.ssllabs.com',
    'A+',
))
    ->toBeBool()
    ->toBeTrue();

it('should handle analyze')->expect(fn () => SslLabsFacade::analyze(
    'www.ssllabs.com',
    null,
    false,
    false,
    true,
    null,
    false
))
    ->toBeArray()
    ->toHaveKeys([
        'host',
        'port',
        'protocol',
        'status',
        'engineVersion',
    ])
    ->host->toBeString()
    ->host->toEqual('www.ssllabs.com')
    ->port->toBeInt()
    ->port->toEqual(443)
    ->protocol->toBeString()
    ->protocol->toEqual('http')
    ->status->toBeString()
    ->engineVersion->toBeString();

it('should handle info')->expect(fn () => SslLabsFacade::info())
    ->toBeArray()
    ->toHaveKeys([
        'engineVersion',
        'messages',
    ])
    ->engineVersion->toBeString()
    ->messages->toBeArray();
