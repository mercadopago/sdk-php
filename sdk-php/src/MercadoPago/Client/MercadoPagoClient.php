<?php

namespace MercadoPago\Client;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
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
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Net\MPResponse response from the request.
     */
    protected function send(string $uri, string $method, ?string $payload = null, ?array $query_params = [], ?RequestOptions $request_options = null): MPResponse
    {
        return $this->http_client->send($this->buildRequest($uri, $method, $payload, $query_params, $request_options));
    }

    private function buildRequest(
        string $path,
        string $method,
        ?string $payload = null,
        ?array $query_params = [],
        ?RequestOptions $request_options = null
    ): MPRequest {
        $path = $this->formatUrlWithQueryParams($path, $query_params);
        return new MPRequest($path, $method, $payload, $this->addHeaders($method, $request_options), $this->addConnectionTimeout($request_options));
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

    private function addHeaders(string $method, ?RequestOptions $request_options = null): array
    {
        $headers = array();
        $headers = $this->addCustomHeaders($headers, $request_options);
        $headers = $this->addTrackingHeaders($headers);
        $headers = $this->addDefaultHeaders($method, $headers, $request_options);
        return $headers;
    }

    private function addCustomHeaders(array $headers, ?RequestOptions $request_options = null): array
    {
        if (!is_null($request_options) && !is_null($request_options->getCustomHeaders())) {
            return array_merge($headers, $request_options->getCustomHeaders());
        }
        return $headers;
    }

    private function addDefaultHeaders(string $method, array $headers, ?RequestOptions $request_options = null): array
    {
        $default_headers = array(
            'Accept: application/json',
            'Content-Type: application/json; charset=UTF-8',
            'Authorization: Bearer ' . $this->getAccessToken($request_options),
            'X-Product-Id: ' . MercadoPagoConfig::$PRODUCT_ID,
            'User-Agent: MercadoPago DX-PHP SDK/' . MercadoPagoConfig::$CURRENT_VERSION,
            'X-Tracking-Id: platform:' . PHP_MAJOR_VERSION . '|' . PHP_VERSION . ',type:SDK' . MercadoPagoConfig::$CURRENT_VERSION . ',so;'
        );

        if ($this->shouldAddIdempotencyKey($method) && !$this->headerExists($headers, 'X-Idempotency-Key')) {
            array_push($default_headers, 'X-Idempotency-Key: ' . $this->getIdempotencyKey($request_options));
        }

        return array_merge($headers, $default_headers);
    }

    private function addTrackingHeaders(array $headers): array
    {
        $tracking_headers = array();
        if (!$this->headerExists($headers, 'X-Platform-Id') && !empty(MercadoPagoConfig::getPlatformId())) {
            array_push($tracking_headers, 'X-Platform-Id: ' . MercadoPagoConfig::getPlatformId());
        }

        if (!$this->headerExists($headers, 'X-Integrator-Id') && !empty(MercadoPagoConfig::getIntegratorId())) {
            array_push($tracking_headers, 'X-Integrator-Id: ' . MercadoPagoConfig::getIntegratorId());
        }

        if (!$this->headerExists($headers, 'X-Corporation-Id') && !empty(MercadoPagoConfig::getCorporationId())) {
            array_push($tracking_headers, 'X-Corporation-Id: ' . MercadoPagoConfig::getCorporationId());
        }

        return array_merge($headers, $tracking_headers);
    }

    private function headerExists(array $headers, string $header): bool
    {
        foreach($headers as $h) {
            $headerName = trim(explode(':', $h, 2)[0]);
            if (strtolower($headerName) == strtolower($header)) {
                return true;
            }
        }
        return false;
    }

    private function getAccessToken(?RequestOptions $request_options = null): string
    {
        return $request_options?->getAccessToken() ?? MercadoPagoConfig::getAccessToken();
    }

    private function shouldAddIdempotencyKey(string $method): bool
    {
        return $method === HttpMethod::POST || $method === HttpMethod::PUT || $method === HttpMethod::PATCH;
    }

    private function getIdempotencyKey(?RequestOptions $request_options = null): string
    {
        $key = "x-idempotency-key";
        if (!is_null($request_options) && !is_null($request_options->getCustomHeaders())) {
            $headers = $request_options->getCustomHeaders();
            if (array_key_exists(strtolower($key), array_change_key_case($headers))) {
                return $headers[strtolower($key)];
            }
        }
        return $this->generateUUID();
    }

    private function addConnectionTimeout(?RequestOptions $request_options = null): int
    {
        return ($request_options?->getConnectionTimeout() ?? 0) > 0
            ? $request_options->getConnectionTimeout()
            : MercadoPagoConfig::getConnectionTimeout();
    }


    private function generateUUID(): string
    {
        $data = random_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
