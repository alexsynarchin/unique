<?php

namespace TextRuApi\Exception;

class UnknownMethodException extends \Exception
{
    public static function unknownMethod($message = "Unknown method", $code = 400130, \Exception $previous = null)
    {
        return new self($message, $code, $previous);
    }
}