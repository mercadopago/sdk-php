<?php

namespace MercadoPago\Client;

use MercadoPago\Core\MPRequestOptions;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPRequest;
use MercadoPago\Net\MPResponse;

/** Mercado Pago client class. */
class MercadoPagoClient
{
    protected $http_client;

    /**
     * MercadoPagoClient constructor.
     */
    public function __construct(MPHttpClient $http_client)
    {
        $this->http_client = $http_client;
    }

    /**
     * Method used directly or by other methods to make requests with request options.
     */
    protected function send(string $uri, string $method, ?string $payload = null, ?MPRequestOptions $request_options = null): MPResponse
    {
        return $this->http_client->send($this->buildRequest($uri, $method, $payload, $request_options));
    }

    private function buildRequest(
        string $path,
        string $method,
        ?string $payload = null,
        ?MPRequestOptions $request_options = null
    ): MPRequest {
        return new MPRequest($path, $method, $payload, $this->addHeaders($request_options), $this->addConnectionTimeout($request_options));
    }

    private function addHeaders(?MPRequestOptions $request_options = null): array
    {
        $headers = array();
        $headers = $this->addCustomHeaders($headers, $request_options);
        $headers = $this->addDefaultHeaders($headers, $request_options);
        return $headers;
    }

    private function addCustomHeaders(array $headers, ?MPRequestOptions $request_options = null): array
    {
        if (!is_null($request_options) && !is_null($request_options->getCustomHeaders())) {
            foreach ($request_options->getCustomHeaders() as $header) {
                array_push($headers, $header);
            }
        }
        return $headers;
    }

    private function addDefaultHeaders(array $headers, ?MPRequestOptions $request_options = null): array
    {
        $default_headers = array(
            'Accept: application/json',
            'Content-Type: application/json; charset=UTF-8',
            'Authorization: Bearer ' . $this->getAccessToken($request_options),
            'X-Product-Id: ' . MercadoPagoConfig::$PRODUCT_ID,
            'User-Agent: MercadoPago DX-PHP SDK/' . MercadoPagoConfig::$CURRENT_VERSION,
            'X-Tracking-Id: platform:' . PHP_MAJOR_VERSION . '|' . PHP_VERSION . ',type:SDK' . MercadoPagoConfig::$CURRENT_VERSION . ',so;'
        );

        foreach ($default_headers as $header) {
            array_push($headers, $header);
        }
        return $headers;
    }

    private function getAccessToken(?MPRequestOptions $request_options = null): string
    {
        return (!is_null($request_options) && !is_null($request_options->getAccessToken()))
            ? $request_options->getAccessToken()
            : MercadoPagoConfig::getAccessToken();
    }

    private function addConnectionTimeout(?MPRequestOptions $request_options = null): int
    {
        return (!is_null($request_options) && !is_null($request_options->getConnectionTimeout() && $request_options->getConnectionTimeout() > 0))
            ? $request_options->getConnectionTimeout()
            : MercadoPagoConfig::getConnectionTimeout();
    }
}
