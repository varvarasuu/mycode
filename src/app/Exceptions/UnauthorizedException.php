<?php

namespace App\Exceptions;

class UnauthorizedException extends BaseException
{
    protected $errorCode;
    protected $additionalData;

    public function __construct($message)
    {
        parent::__construct($message, 401);
        $this->errorCode = 401;
    }
}
