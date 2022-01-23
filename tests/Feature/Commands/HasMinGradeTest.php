<?php

namespace AdrianMejias\SslLabs\Tests\Feature\Commands;

use Illuminate\Support\Facades\Artisan;

/** @covers \AdrianMejias\SslLabs\Commands\HasMinGradeCommand */
it('should handle HasMinGradeCommand')->expect(
    fn () => Artisan::call(
        'ssllabs:has-min-grade',
        ['host' => 'www.ssllabs.com', 'grade' => 'A+']
    )
)
    ->toBeInt()
    ->toEqual(1);
