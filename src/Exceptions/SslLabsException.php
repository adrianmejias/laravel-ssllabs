<?php

namespace AdrianMejias\SslLabs\Exceptions;

use Exception;
use Throwable;

/**
 * SSL Labs Exception
 *
 * @package AdrianMejias\SslLabs\Exceptions
 */
class SslLabsException extends Exception
{
    /**
     * SSL Labs Exception constructor.
     *
     * @param  null|string  $message
     * @param  int  $code
     * @param  null|Throwable  $previous
     */
    public function __construct(
        ?string $message = null,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            $message ?? 'Something went wrong.',
            $code,
            $previous
        );
    }
}
