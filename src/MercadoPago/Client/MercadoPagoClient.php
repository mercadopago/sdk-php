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
    protected $httpClient;

    /**
     * MercadoPagoClient constructor.
     */
    public function __construct(MPHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Method used directly or by other methods to make requests with request options.
     */
    protected function send(string $uri, string $method, ?string $payload = null, ?MPRequestOptions $requestOptions = null): MPResponse
    {
        return $this->httpClient->send($this->buildRequest($uri, $method, $payload, $requestOptions));
    }

    private function buildRequest(
        string $path,
        string $method,
        ?string $payload = null,
        ?MPRequestOptions $requestOptions = null
    ): MPRequest {
        return new MPRequest($path, $method, $payload, $this->addHeaders($requestOptions), $this->addConnectionTimeout($requestOptions));
    }

    private function addHeaders(?MPRequestOptions $requestOptions = null): array
    {
        $headers = array();
        $headers = $this->addCustomHeaders($headers, $requestOptions);
        $headers = $this->addDefaultHeaders($headers, $requestOptions);
        return $headers;
    }

    private function addCustomHeaders(array $headers, ?MPRequestOptions $requestOptions = null): array
    {
        if (!is_null($requestOptions) && !is_null($requestOptions->getCustomHeaders())) {
            foreach ($requestOptions->getCustomHeaders() as $header) {
                array_push($headers, $header);
            }
        }
        return $headers;
    }

    private function addDefaultHeaders(array $headers, ?MPRequestOptions $requestOptions = null): array
    {
        $defaultHeaders = array(
            'Accept: application/json',
            'Content-Type: application/json; charset=UTF-8',
            'Authorization: Bearer ' . $this->getAccessToken($requestOptions),
            'X-Product-Id: ' . MercadoPagoConfig::$PRODUCT_ID,
            'User-Agent: MercadoPago DX-PHP SDK/' . MercadoPagoConfig::$CURRENT_VERSION,
            'X-Tracking-Id: platform:' . PHP_MAJOR_VERSION . '|' . PHP_VERSION . ',type:SDK' . MercadoPagoConfig::$CURRENT_VERSION . ',so;'
        );

        foreach ($defaultHeaders as $header) {
            array_push($headers, $header);
        }
        return $headers;
    }

    private function getAccessToken(?MPRequestOptions $requestOptions = null): string
    {
        return (!is_null($requestOptions) && !is_null($requestOptions->getAccessToken()))
            ? $requestOptions->getAccessToken()
            : MercadoPagoConfig::getAccessToken();
    }

    private function addConnectionTimeout(?MPRequestOptions $requestOptions = null): int
    {
        return (!is_null($requestOptions) && !is_null($requestOptions->getConnectionTimeout() && $requestOptions->getConnectionTimeout() > 0))
            ? $requestOptions->getConnectionTimeout()
            : MercadoPagoConfig::getConnectionTimeout();
    }
}
