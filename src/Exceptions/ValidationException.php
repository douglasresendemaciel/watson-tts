<?php

namespace Robtesch\WatsonTTS\Exceptions;

use Exception;

/**
 * Class ValidationException
 * @package Robtesch\WatsonTTS\Exceptions
 */
class ValidationException extends Exception
{
    /**
     * ValidationException constructor.
     * @param $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message, $code = 422, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
