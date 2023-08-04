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
     * @param \MercadoPago\Net\MPHttpClient $http_client http client to be used.
     */
    public function __construct(MPHttpClient $http_client)
    {
        $this->http_client = $http_client;
    }

    /**
     * Method used directly or by other methods to make requests with request options.
     * @param string $uri path to be requested.
     * @param string $method method to be used.
     * @param mixed $payload payload to be sent.
     * @param mixed $queryParams query params to be sent.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Net\MPResponse response from the request.
     */
    protected function send(string $uri, string $method, ?string $payload = null, ?array $queryParams = [], ?MPRequestOptions $request_options = null): MPResponse
    {
        return $this->http_client->send($this->buildRequest($uri, $method, $payload, $queryParams, $request_options));
    }

    private function buildRequest(
        string $path,
        string $method,
        ?string $payload = null,
        ?array $queryParams = [],
        ?MPRequestOptions $request_options = null
    ): MPRequest {
        $path = $this->formatUrlWithQueryParams($path, $queryParams);
        return new MPRequest($path, $method, $payload, $this->addHeaders($request_options), $this->addConnectionTimeout($request_options));
    }

    private function formatUrlWithQueryParams(string $url, ?array $queryParams): string
    {
        if (!empty($queryParams)) {
            $queryString = http_build_query($queryParams);

            if (strpos($url, '?') !== false) {
                $url .= '&' . $queryString;
            } else {
                $url .= '?' . $queryString;
            }
        }
        return $url;
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
            return array_merge($headers, $request_options->getCustomHeaders());
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

        return array_merge($headers, $default_headers);
    }

    private function getAccessToken(?MPRequestOptions $request_options = null): string
    {
        return $request_options?->getAccessToken() ?? MercadoPagoConfig::getAccessToken();
    }

    private function addConnectionTimeout(?MPRequestOptions $request_options = null): int
    {
        return ($request_options?->getConnectionTimeout() ?? 0) > 0
            ? $request_options->getConnectionTimeout()
            : MercadoPagoConfig::getConnectionTimeout();
    }
}
