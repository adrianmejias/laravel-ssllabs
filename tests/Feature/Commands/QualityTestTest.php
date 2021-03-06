<?php

namespace AdrianMejias\SslLabs\Tests\Feature\Commands;

use Illuminate\Support\Facades\Artisan;

/** @covers \AdrianMejias\SslLabs\Commands\QualityTestCommand */
it('should handle QualityTestCommand')->expect(
    fn () => Artisan::call(
        'ssllabs:quality-test',
        ['host' => 'www.ssllabs.com', 'grade' => 'A+']
    )
)
    ->toBeInt()
    ->toEqual(1);
