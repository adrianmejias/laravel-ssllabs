<?php

namespace AdrianMejias\SslLabs\Tests\Unit\Commands;

use Illuminate\Support\Facades\Artisan;

/** @covers \AdrianMejias\SslLabs\Commands\HasMinGradeCommand */
it('should handle mock HasMinGradeCommand', function () {
    Artisan::shouldReceive('call')->once()
        ->with(
            'ssllabs:has-min-grade',
            ['host' => 'www.ssllabs.com', 'grade' => 'A+']
        )
        ->andReturn(1);

    $result = Artisan::call(
        'ssllabs:has-min-grade',
        ['host' => 'www.ssllabs.com', 'grade' => 'A+']
    );
    expect($result)->toBeInt()->toEqual(1);
});
