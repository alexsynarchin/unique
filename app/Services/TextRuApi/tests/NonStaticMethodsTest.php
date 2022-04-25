<?php

namespace TextRuApi\Tests;

require_once __DIR__ . "/../src/TextRuApi.php";
require_once __DIR__ . "/../src/Exception/CurlRequestException.php";
require_once __DIR__ . "/../src/Exception/WrongParameterException.php";

use TextRuApi\Exception\WrongParameterException;
use TextRuApi\Exception\UnknownMethodException;
use TextRuApi\TextRuApi;


class NonStaticMethodsTest extends \PHPUnit_Framework_TestCase
{
    public function test_empty_userkey_rise_exception()
    {
        $this->expectException(WrongParameterException::class);
        $this->expectExceptionCode(400128);
        $app = new TextRuApi("");
    }

    public function test_unknown_method_exception()
    {
        $this->expectException(UnknownMethodException::class);
        $this->expectExceptionCode(400126);
        $app = new TextRuApi("testkey");
        $app->unknownMethod();
    }

    public function test_too_short_text()
    {
        $app = new TextRuApi("testkey");
        $result = $app->add("Short test text");
        $this->assertEquals(112, $result["error"]["code"]);
    }

    public function test_wrong_userkey()
    {
        $app = new TextRuApi("php_unit_test");
        $result = $app->add("Test test test test test test test test test test test test test test test test test test test test test");
        $this->assertEquals(140, $result["error"]["code"]);
    }

    public function test_default_option_not_in_allowed_list()
    {
        $this->expectException(WrongParameterException::class);
        $this->expectExceptionCode(400122);
        $app = new TextRuApi("test", ["unknown_option" => "test"]);
    }

    public function test_get_account_info()
    {
        $app = new TextRuApi("php_unit_test");
        $result = $app->account();
        $this->assertTrue($result['size'] > 0);
    }
}
