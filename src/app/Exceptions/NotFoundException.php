<?php

namespace App\Exceptions;

class NotFoundException extends BaseException
{
    protected $errorCode;
    protected $additionalData;

    public function __construct($message)
    {
        parent::__construct($message, 404);
        $this->errorCode = 404;
    }
}
