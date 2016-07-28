<?php
namespace MercadoPago\Http;

use Exception;

/**
 * CurlRequest Class Doc Comment
 *
 * @package MercadoPago\Http
 */
class CurlRequest
    implements HttpRequest
{
    /**
     * @var null|resource
     */
    private $handle = null;

    /**
     * CurlRequest constructor.
     *
     * @param null $uri
     */
    public function __construct($uri = null)
    {
        if (!extension_loaded("curl")) {
            throw new Exception("cURL extension not found. You need to enable cURL in your php.ini or another configuration you have.");
        }
        $this->handle = curl_init($uri);

        return $this->handle;
    }

    /**
     * @param $name
     * @param $value
     */
    public function setOption($name, $value)
    {
        curl_setopt($this->handle, $name, $value);
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        return curl_exec($this->handle);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getInfo($name)
    {
        return curl_getinfo($this->handle, $name);
    }

    /**
     *
     */
    public function close()
    {
        curl_close($this->handle);
    }

    /**
     * @return string
     */
    public function error()
    {
        return curl_error($this->handle);
    }
}