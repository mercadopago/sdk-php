<?php

namespace MercadoPago\Net;

use Exception;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

/** Mercado Pago default Http Client class. */
class MPDefaultHttpClient implements MPHttpClient
{
    private const ONE_MILLISECOND = 1000;

    private HttpRequest $httpRequest;

    /**
     * Default constructor.
     * @param \MercadoPago\Net\HttpRequest|null $httpRequest http request to be used.
     */
    public function __construct(?HttpRequest $httpRequest = null)
    {
        $this->httpRequest = $httpRequest ?? new CurlRequest();
    }

    /**
     * Send Mercado Pago request
     * @param \MercadoPago\Net\MPRequest $request request to be sent.
     * @throws \Exception if the request fails.
     * @throws \MercadoPago\Exceptions\MPApiException if api call returns error.
     * @return \MercadoPago\Net\MPResponse response from the request.
     */
    public function send(MPRequest $request): MPResponse
    {
        $max_retries = MercadoPagoConfig::getMaxRetries();

        for ($retry_count = 0; $retry_count <= $max_retries; $retry_count++) {
            try {
                return $this->makeRequest($request);
            } catch (MPApiException $e) {
                $status_code = $e->getApiResponse()->getStatusCode();
                if ($this->isServerError($status_code) && !$this->isLastRetry($retry_count)) {
                    $this->doExponentialBackoff($retry_count);
                } else {
                    throw $e;
                }
            } catch (Exception $e) {
                if (!$this->isLastRetry($retry_count)) {
                    $this->doExponentialBackoff($retry_count);
                } else {
                    throw $e;
                }
            }
        }

        throw new Exception("Error processing request. Please try again.");
    }

    private function makeRequest(MPRequest $request): MPResponse
    {
        $request_options = $this->createHttpRequestOptions($request);
        $this->httpRequest->setOptionArray($request_options);
        $api_result = $this->httpRequest->execute();
        $status_code = $this->httpRequest->getInfo(CURLINFO_HTTP_CODE);
        $content = json_decode($api_result, true);
        $mp_response = new MPResponse($status_code, $content);

        if ($api_result === false) {
            $error_message = $this->httpRequest->error();
            $this->httpRequest->close();
            throw new Exception($error_message);
        }
        if ($this->isApiError($status_code)) {
            $this->httpRequest->close();
            throw new MPApiException("Api error. Check response for details", $mp_response);
        }

        $this->httpRequest->close();
        return $mp_response;
    }

    private function doExponentialBackoff(int $retry_count): void
    {
        $exponential_backoff_time = pow(2, $retry_count);
        $retry_delay_microseconds = $exponential_backoff_time * self::ONE_MILLISECOND * MercadoPagoConfig::getRetryDelay();
        usleep($retry_delay_microseconds);
    }

    private function createHttpRequestOptions(MPRequest $request): array
    {
        $connection_timeout = $request->getConnectionTimeout() ?: MercadoPagoConfig::getConnectionTimeout();

        $options = array(
            CURLOPT_URL => MercadoPagoConfig::$BASE_URL . $request->getUri(),
            CURLOPT_CUSTOMREQUEST => $request->getMethod(),
            CURLOPT_HTTPHEADER => $request->getHeaders(),
            CURLOPT_POSTFIELDS => $request->getPayload(),
            CURLOPT_CONNECTTIMEOUT_MS => $connection_timeout,
            CURLOPT_MAXCONNECTS => MercadoPagoConfig::getMaxConnections(),
            CURLOPT_RETURNTRANSFER => true
        );

        if (MercadoPagoConfig::getRuntimeEnviroment() === MercadoPagoConfig::LOCAL) {
            $options += [CURLOPT_SSL_VERIFYHOST => false];
            $options += [CURLOPT_SSL_VERIFYPEER => false];
        }

        return $options;
    }

    private function isServerError(int $status_code): bool
    {
        return $status_code >= 500;
    }

    private function isApiError(int $status_code): bool
    {
        return $status_code < 200 || $status_code >= 300;
    }

    private function isLastRetry(int $retry_count): bool
    {
        return $retry_count >= MercadoPagoConfig::getMaxRetries();
    }
}
