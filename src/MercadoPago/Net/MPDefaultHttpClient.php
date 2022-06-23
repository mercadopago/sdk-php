<?php

namespace MercadoPago\Net;

use Exception;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

/** Mercado Pago default Http Client class. */
class MPDefaultHttpClient implements MPHttpClient
{
    public function send(MPRequest $request): MPResponse
    {
        $connect = curl_init();

        try {
            $complete_request = $this->createHttpRequest($request);
            curl_setopt_array($connect, $complete_request);
            $api_result = curl_exec($connect);
            $status_code = curl_getinfo($connect, CURLINFO_HTTP_CODE);
            $content = json_decode($api_result, true);
            $mp_response = new MPResponse($status_code, $content);

            if (!empty(curl_error($connect)) || $api_result === false) {
                $error_message = curl_error($connect);
                throw new Exception($error_message);
            }

            if ($status_code != "200" && $status_code != "201") {
                throw new MPApiException("Api error. Check response for details", $mp_response);
            }

            return $mp_response;
        } finally {
            curl_close($connect);
        }
    }

    private function createHttpRequest(MPRequest $request): array
    {
        $connection_timeout =
            $request->getConnectionTimeout() != 0
            ? $request->getConnectionTimeout()
            : MercadoPagoConfig::getConnectionTimeout();

        return array(
            CURLOPT_URL => MercadoPagoConfig::$BASE_URL . $request->getUri(),
            CURLOPT_CUSTOMREQUEST => $request->getMethod(),
            CURLOPT_HTTPHEADER => $request->getHeaders(),
            CURLOPT_POSTFIELDS => $request->getPayload(),
            CURLOPT_CONNECTTIMEOUT_MS => $connection_timeout,
            CURLOPT_MAXCONNECTS => MercadoPagoConfig::getMaxConnections(),
            CURLOPT_RETURNTRANSFER => true
        );
    }
}
