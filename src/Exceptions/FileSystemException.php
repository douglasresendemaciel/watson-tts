<?php

namespace Robtesch\WatsonTTS\Exceptions;

use Exception;

/**
 * Class FileSystemException
 * @package Robtesch\WatsonTTS\Exceptions
 */
class FileSystemException extends Exception
{
    /**
     * FileSystemException constructor.
     * @param $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message, $code = 422, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
