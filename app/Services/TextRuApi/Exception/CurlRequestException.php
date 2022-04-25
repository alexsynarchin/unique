<?php

namespace TextRuApi\Exception;

class CurlRequestException extends \Exception
{
    public static function curlRequestException($message = "Curl request exception", $code = 0, \Exception $previous = null)
    {
        return new self($message, $code, $previous);
    }
}
