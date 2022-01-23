<?php

namespace AdrianMejias\SslLabs\Tests\Unit\Commands;

use Illuminate\Support\Facades\Artisan;

/** @covers \AdrianMejias\SslLabs\Commands\QualityTestCommand */
it('should handle mock QualityTestCommand', function () {
    Artisan::shouldReceive('call')->once()
        ->with(
            'ssllabs:quality-test',
            ['host' => 'www.ssllabs.com', 'grade' => 'A+']
        )
        ->andReturn(1);

    $result = Artisan::call(
        'ssllabs:quality-test',
        ['host' => 'www.ssllabs.com', 'grade' => 'A+']
    );
    expect($result)->toBeInt()->toEqual(1);
});
