<?php

namespace App\Exceptions;

class ServerErrorException extends BaseException
{
    protected $errorCode;
    protected $additionalData;

    public function __construct($message)
    {
        parent::__construct($message, 500);
        $this->errorCode = 500;
    }
}
