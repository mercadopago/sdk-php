<?php

namespace MercadoPago;


class FakeApiHub
{
    private $_files = [
        '/oauth/token'        => 'mp_connect.json',
        '/v1/payment_methods' => 'payment_methods.json',
    ];

    public function getJson($method, $endPoint)
    {
        switch ($method) {
            case 'GET': {
                return $this->getFile($endPoint);
                break;
            }
            case 'POST': {
                return $this->getFile($endPoint);
                break;
            }
            default:
                return '';
        }

    }

    private function getFile($endpoint)
    {
        return file_get_contents(dirname(__FILE__) . '/json_files/' . $this->_files[$endpoint]);
    }
}