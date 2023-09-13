<?php

namespace App\Exceptions;

use Exception;

class BaseException extends Exception
{
    protected $errorCode;
    protected $additionalData;
    public function __construct($message, $code, $additionalData = null)
    {
        parent::__construct($message);
        $this->errorCode = $code;
        $this->additionalData = $additionalData;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getAdditionalData()
    {
        return $this->additionalData;
    }
}
