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
    /**
     * MercadoPagoClient constructor.
     * @param \MercadoPago\Net\MPHttpClient $http_client http client to be used.
     */
    public function __construct(protected MPHttpClient $http_client)
    {
    }

    /**
     * Method used directly or by other methods to make requests with request options.
     * @param string $uri path to be requested.
     * @param string $method method to be used.
     * @param mixed $payload payload to be sent.
     * @param mixed $query_params query params to be sent.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Net\MPResponse response from the request.
     */
    protected function send(string $uri, string $method, ?string $payload = null, ?array $query_params = [], ?MPRequestOptions $request_options = null): MPResponse
    {
        return $this->http_client->send($this->buildRequest($uri, $method, $payload, $query_params, $request_options));
    }

    private function buildRequest(
        string $path,
        string $method,
        ?string $payload = null,
        ?array $query_params = [],
        ?MPRequestOptions $request_options = null
    ): MPRequest {
        $path = $this->formatUrlWithQueryParams($path, $query_params);
        return new MPRequest($path, $method, $payload, $this->addHeaders($request_options), $this->addConnectionTimeout($request_options));
    }

    private function formatUrlWithQueryParams(string $url, ?array $query_params): string
    {
        if (!empty($query_params)) {
            $query_string = http_build_query($query_params);

            if (strpos($url, '?') !== false) {
                $url .= '&' . $query_string;
            } else {
                $url .= '?' . $query_string;
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
