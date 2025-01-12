<?php

namespace Akshay\Url_down\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class DownErrorException extends HttpException
{
    public function __construct(int $statusCode = 500, string $message = 'An error occurred', ?\Throwable $previous = null)
    {
        parent::__construct($statusCode, $message, $previous);
    }
}
