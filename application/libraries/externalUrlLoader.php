<?php
/**
 * Created by PhpStorm.
 * User: manuel.pulgar
 * Date: 26/10/17
 * Time: 15:30
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class ExternalUrlLoader
{

    public function load($url, $user_agent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36') {
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,$url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($user_agent)) {
            curl_setopt($curl_handle, CURLOPT_USERAGENT, $user_agent);
        }
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);

        //var_dump($response);
        return $response;
    }

}