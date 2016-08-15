<?php

namespace App\Http\Common;

class CommonUtils
{


    /**
     * 调用游戏rpc
     * @param $url
     * @param $cmd
     * @param array $params
     * @return array
     */
    static function callGameRpc($url, $cmd, array $params = [])
    {
        $paramString = json_encode($params);
        return self::http($url, [
            'command' => $cmd,
            'params' => $paramString
        ]);
    }

    /**
     * 调用游戏rpc
     * @param $cmd
     * @param array $params
     * @param null $specialUrl
     * @return array
     */
    static function callAPIRpc($cmd, array $params = [], $specialUrl = null)
    {
        $params['clientVersion'] = "2.2.0";
        return self::callGameRpc(is_null($specialUrl) ?
            config('gamerpc')['API_URL'] : $specialUrl,
            $cmd, $params);
    }

    /**
     * 调用GMRPC
     * @param $cmd
     * @param array $params
     * @param null $specialUrl
     * @return CommonReturnVar
     */
    static function GMAPICall($cmd, array $params = [], $specialUrl = null)
    {
        $httpResponse = self::callAPIRpc($cmd, $params, $specialUrl);
        if ($httpResponse["http_code"] != 200) {
            return CommonReturnVar::RetFail(200, $httpResponse, 'httpcode_error');
        }
//        dump($httpResponse['response']);
        $jsonObject = json_decode($httpResponse['response'], true)[0];
//        dump($jsonObject);
        return CommonReturnVar::create_with_message_arr($jsonObject);
    }

    /**
     *
     * @param $url
     * @param string $query
     * @param string $method
     * @return array
     */
    static function http($url, $query = "", $method = 'POST')
    {
        $ch = curl_init();
        switch (strtoupper($method)) {
            case 'GET' :
                if (false === stripos($url, '?')) {
                    $url .= '?' . $query;
                } else {
                    $url .= '&' . $query;
                }
                break;
            case 'POST' :
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
                break;
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        $response = trim(curl_exec($ch));
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $result = array(
            "response" => $response,
            "http_code" => $http_code
        );
        return $result;
    }
}