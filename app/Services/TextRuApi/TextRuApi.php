<?php

namespace App\Services\TextRuApi;

use App\Services\TextRuApi\Exception\WrongParameterException;
use App\Services\TextRuApi\Exception\CurlRequestException;
use App\Services\TextRuApi\Exception\UnknownMethodException;

class TextRuApi
{
    const TEXT_URL = 'http://api.text.ru/post';

    const ACCOUNT_URL = 'http://api.text.ru/account';

    private $userkey;

    private $default_options;

    private static $allowed_options_get = ["exceptdomain", "excepturl", "visible", "copying", "callback"];

    public function __construct($userkey, $default_options = [])
    {
        if (empty($userkey)) throw WrongParameterException::wrongParameter("userkey is empty", 400128);

        $this->userkey = $userkey;

        foreach ($default_options as $key => $value) {
            if (!in_array($key, self::$allowed_options_get)) throw WrongParameterException::wrongParameter("Unknown option " . $key . " provided", 400122);
        }
        $this->default_options = $default_options;
    }

    /**
     * Return $userkey or set $userkey if param provided
     * @param null $userkey
     * @return $this
     */
    public function userkey($userkey = null)
    {
        if (is_null($userkey)) return $this->userkey;

        $this->userkey = $userkey;

        return $this;
    }

    /**
     * Send API add request to TextRu
     * @param $userkey
     * @param $text
     * @param array $options
     * @return array
     * @throws WrongParameterException
     */
    private static function add_to_textru($userkey, $text, $options = [])
    {
        if ((empty($userkey)) || (empty($text))) throw WrongParameterException::wrongParameter("Required params is empty", 400123);

        if (!is_array($options)) throw WrongParameterException::wrongParameter("Options param must be array", 400124);

        foreach ($options as $key => $value) {
            if (!in_array($key, self::$allowed_options_get)) throw WrongParameterException::wrongParameter("Unknown option " . $key . " provided", 400125);
        }

        $post_options = ["userkey" => $userkey, "text" => $text];
        if (!empty($options)) $post_options = array_merge($post_options, $options);

        $answer_decoded = self::sendCurl($post_options);

        $result = [
            "error"    => ["code" => null, "desc" => null],
            "text_uid" => null,
        ];

        if (isset($answer_decoded->error_code)) $result["error"]["code"] = $answer_decoded->error_code;
        if (isset($answer_decoded->error_desc)) $result["error"]["desc"] = $answer_decoded->error_desc;
        if (isset($answer_decoded->text_uid)) $result["text_uid"] = $answer_decoded->text_uid;

        return $result;

    }

    /**
     * Get Account info from API
     * @param $userkey
     * @return array
     * @throws CurlRequestException
     */
    private static function get_account_info($userkey)
    {
        $query = 'method=get_packages_info&userkey='.$userkey;
        $response = self::sendCurl($query, self::ACCOUNT_URL);

        return [
            "error" => [
                "code" => (isset($response->error_code)) ? $response->error_code : null,
                "desc" => (isset($response->error_desc)) ? $response->error_desc : null,
            ],
            "size"  => (isset($response->size)) ? $response->size : null
        ];
    }

    /**
     * Send API get request to TextRu
     * @param $userkey
     * @param $uid
     * @param null $jsonvisible
     * @return array
     * @throws WrongParameterException
     */
    private static function get_from_textru($userkey, $uid, $jsonvisible = null)
    {
        if ((empty($userkey)) || (empty($uid))) throw WrongParameterException::wrongParameter("Required params is empty", 400131);

        $post_options = ["userkey" => $userkey, "uid" => $uid];
        if (!is_null($jsonvisible)) $post_options["jsonvisible"] = "detail_view";

        $answer_decoded = self::sendCurl($post_options);

        $result = [
            "error"       => ["code" => null, "desc" => null],
            "text_unique" => null,
            "result_json" => null,
            "spell_check" => null,
            "seo_check"   => null,
            "text_view"   => null,
            "words_pos"   => null
        ];

        if (isset($answer_decoded->error_code)) $result["error"]["code"] = $answer_decoded->error_code;
        if (isset($answer_decoded->error_desc)) $result["error"]["desc"] = $answer_decoded->error_desc;

        if (isset($answer_decoded->text_unique)) $result["text_unique"] = $answer_decoded->text_unique;
        if (isset($answer_decoded->result_json)) $result["result_json"] = $answer_decoded->result_json;
        if (isset($answer_decoded->spell_check)) $result["spell_check"] = $answer_decoded->spell_check;
        if (isset($answer_decoded->seo_check)) $result["seo_check"] = $answer_decoded->seo_check;
        if (isset($answer_decoded->text_view)) $result["text_view"] = $answer_decoded->text_view;
        if (isset($answer_decoded->words_pos)) $result["words_pos"] = $answer_decoded->words_pos;
        return $result;
    }

    /**
     * Curl wrapper, send POST request with predefined settings
     * @param $postfields
     * @param string $url
     * @return mixed
     * @throws CurlRequestException
     */
    public static function sendCurl($postfields, $url = self::TEXT_URL)
    {
        if (is_array($postfields)) $postfields = http_build_query($postfields, '', '&');

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST           => 1,
            CURLOPT_POSTFIELDS     => $postfields,
        ]);
        $answer = curl_exec($ch);
        $errno = curl_errno($ch);

        if ($errno) throw CurlRequestException::curlRequestException(curl_error($ch), $errno);

        return json_decode($answer);
    }

    /**
     * PHP magic method, for non-static methods
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws UnknownMethodException
     */
    public function __call($name, $arguments)
    {
        if ($name === 'add') {
            return call_user_func_array([$this, 'add_to_textru'], array_merge([$this->userkey], $arguments));
        }

        if ($name === 'get') {

            return call_user_func_array([$this, 'get_from_textru'], array_merge([$this->userkey], $arguments));
        }

        if ($name === 'account') {
            return call_user_func_array([$this, 'get_account_info'], array_merge([$this->userkey], $arguments));
        }

        throw UnknownMethodException::unknownMethod("Unknown method " . $name, 400126);
    }

    /**
     * PHP magic method, for static methods
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws UnknownMethodException
     */
    public static function __callStatic($name, $arguments)
    {
        if ($name === 'add') {
            return call_user_func_array(['self', 'add_to_textru'], $arguments);
        }

        if ($name === 'get') {
            return call_user_func_array(['self', 'get_from_textru'], $arguments);
        }

        if ($name === 'account') {
            return call_user_func_array(['self', 'get_account_info'], $arguments);
        }

        throw UnknownMethodException::unknownMethod("Unknown static method " . $name, 400127);
    }
}
