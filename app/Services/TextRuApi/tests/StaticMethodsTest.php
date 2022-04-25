<?php

namespace TextRuApi\Tests;

require_once __DIR__ . "/../src/TextRuApi.php";
require_once __DIR__ . "/../src/Exception/CurlRequestException.php";
require_once __DIR__ . "/../src/Exception/WrongParameterException.php";

use TextRuApi\Exception\WrongParameterException;
use TextRuApi\Exception\UnknownMethodException;
use TextRuApi\TextRuApi;


class StaticMethodsTest extends \PHPUnit_Framework_TestCase
{
    public function test_empty_userkey_rise_exception()
    {
        $this->expectException(WrongParameterException::class);
        $this->expectExceptionCode(400123);
        TextRuApi::add("", "Test text");
    }

    public function test_unknown_static_method_exception()
    {
        $this->expectException(UnknownMethodException::class);
        $this->expectExceptionCode(400127);
        TextRuApi::unknownMethod();
    }

    public function test_too_short_text()
    {
        $result = TextRuApi::add("afldkfjlas", "Short test text");
        $this->assertEquals(112, $result["error"]["code"]);
    }

    public function test_wrong_userkey()
    {
        $result = TextRuApi::add("php_unit_test", "Test test test test test test test test test test test test test test test test test test test test test");
        $this->assertEquals(140, $result["error"]["code"]);
    }

    public function test_get_account_info()
    {
        $result = TextRuApi::account("php_unit_test");
        $this->assertTrue($result['size'] > 0);
    }
}
