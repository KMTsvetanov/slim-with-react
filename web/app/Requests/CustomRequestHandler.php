<?php

namespace App\Requests;

use Psr\Http\Message\RequestInterface;

/**
 * Class CustomRequestHandler
 * @package App\Requests
 */
class CustomRequestHandler
{
    /**
     * @param RequestInterface $request
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public static function getParam(RequestInterface $request, $key, $default = null)
    {
        $postParams = $request->getParsedBody();
        $getParams = $request->getQueryParams();

        $getBody = json_encode($request->getBody(), true);

        $result = $default;

        if (is_array($postParams) && isset($postParams[$key])) {
           $result = $postParams[$key];
        } elseif (is_object($postParams) && property_exists($postParams, $key)) {
            $result = $postParams->$key;
        } elseif (is_array($getBody) && $getBody[$key]) {
            $result = $getBody[$key];
        } elseif (isset($getParams[$key])) {
            $result = $getParams[$key];
        }

        return $result;
    }
}