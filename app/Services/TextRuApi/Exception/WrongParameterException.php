<?php

namespace TextRuApi\Exception;

class WrongParameterException extends \Exception
{

    public static function wrongParameter($message = "Wrong parameter", $code = 400120, \Exception $previous = null)
    {
        return new self($message, $code, $previous);
    }

}