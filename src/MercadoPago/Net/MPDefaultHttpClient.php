<?php

namespace MercadoPago\Net;

use Exception;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Exceptions\MPAuthenticationException;
use MercadoPago\Exceptions\MPBadRequestException;
use MercadoPago\Exceptions\MPConnectionException;
use MercadoPago\Exceptions\MPDependencyException;
use MercadoPago\Exceptions\MPForbiddenException;
use MercadoPago\Exceptions\MPIdempotencyException;
use MercadoPago\Exceptions\MPNotFoundException;
use MercadoPago\Exceptions\MPPaymentException;
use MercadoPago\Exceptions\MPRateLimitException;
use MercadoPago\Exceptions\MPResourceLockedException;
use MercadoPago\Exceptions\MPServerException;
use MercadoPago\Exceptions\MPValidationException;
use MercadoPago\MercadoPagoConfig;

/**
 * Default cURL-based HTTP client for the MercadoPago SDK.
 *
 * Implements automatic retry with exponential backoff for server errors (5xx)
 * and transport failures. Retry count and delay are configured via
 * {@see \MercadoPago\MercadoPagoConfig::setMaxRetries()} and
 * {@see \MercadoPago\MercadoPagoConfig::setRetryDelay()}.
 *
 * SSL verification is disabled when the runtime environment is set to
 * {@see \MercadoPago\MercadoPagoConfig::LOCAL} — never use LOCAL in production.
 */
class MPDefaultHttpClient implements MPHttpClient
{
    /** Microseconds per millisecond, used to convert retry delay to usleep units. */
    private const ONE_MILLISECOND = 1000;

    private const RETRY_AFTER_HEADER = 'Retry-After';

    private HttpRequest $httpRequest;

    /**
     * @param HttpRequest|null $httpRequest Custom transport implementation. Defaults to {@see CurlRequest}.
     */
    public function __construct(?HttpRequest $httpRequest = null)
    {
        $this->httpRequest = $httpRequest ?? new CurlRequest();
    }

    /**
     * Sends the request with automatic retry on server errors and transport failures.
     *
     * Retries use exponential backoff: delay = 2^attempt × base_delay.
     * Client errors (4xx) are thrown immediately without retrying.
     *
     * @param MPRequest $request The fully-built API request.
     * @return MPResponse Parsed response on success (2xx).
     * @throws MPApiException When the API returns a non-2xx status code after exhausting retries.
     * @throws \Exception On transport-level errors (e.g., DNS failure, timeout) after exhausting retries.
     */
    public function send(MPRequest $request): MPResponse
    {
        $max_retries = $request->getMaxRetries() ?? MercadoPagoConfig::getMaxRetries();
        $retry_on    = $request->getRetryOn()    ?? RequestOptions::DEFAULT_RETRY_ON;
        $initial_ms  = $request->getInitialDelayMs() ?? (MercadoPagoConfig::getRetryDelay() ?: 200);
        $max_ms      = $request->getMaxDelayMs()     ?? RequestOptions::DEFAULT_MAX_DELAY_MS;
        $use_jitter  = $request->getJitter()         ?? false;
        $on_retry    = $request->getOnRetry();

        $last_exception = null;

        for ($attempt = 0; $attempt <= $max_retries; $attempt++) {
            try {
                return $this->makeRequest($request);
            } catch (MPApiException $e) {
                $status_code = $e->getApiResponse()->getStatusCode();
                if ($attempt < $max_retries && in_array($status_code, $retry_on, true)) {
                    $last_exception = $e;
                    if ($on_retry !== null) {
                        ($on_retry)($attempt + 1, $e);
                    }
                    $this->sleepMicroseconds(
                        $this->computeDelayMicroseconds($attempt, $initial_ms, $max_ms, $use_jitter)
                    );
                } else {
                    throw $e;
                }
            } catch (Exception $e) {
                if ($attempt < $max_retries) {
                    $last_exception = $e;
                    if ($on_retry !== null) {
                        ($on_retry)($attempt + 1, $e);
                    }
                    $this->sleepMicroseconds(
                        $this->computeDelayMicroseconds($attempt, $initial_ms, $max_ms, $use_jitter)
                    );
                } else {
                    throw $e;
                }
            }
        }

        if ($last_exception !== null) {
            throw $last_exception;
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
            throw $this->buildApiException($status_code, $mp_response);
        }

        $this->httpRequest->close();
        return $mp_response;
    }

    private function buildApiException(int $status_code, MPResponse $response): MPApiException
    {
        $msg = "Api error. Check response for details";
        return match(true) {
            $status_code === 400 => new MPBadRequestException($msg, $response),
            $status_code === 401 => new MPAuthenticationException($msg, $response),
            $status_code === 402 => new MPPaymentException($msg, $response),
            $status_code === 403 => new MPForbiddenException($msg, $response),
            $status_code === 404 => new MPNotFoundException($msg, $response),
            $status_code === 409 => new MPIdempotencyException($msg, $response),
            $status_code === 422 => new MPValidationException($msg, $response),
            $status_code === 423 => new MPResourceLockedException($msg, $response),
            $status_code === 424 => new MPDependencyException($msg, $response),
            $status_code === 429 => new MPRateLimitException($msg, $response),
            $status_code >= 500  => new MPServerException($msg, $response),
            default              => new MPApiException($msg, $response),
        };
    }

    private function computeDelayMicroseconds(int $attempt, int $initial_ms, int $max_ms, bool $use_jitter): int
    {
        $exponential = (int) ($initial_ms * pow(2, $attempt));
        $capped = min($exponential, $max_ms);
        if ($use_jitter && $capped > 0) {
            $capped = random_int(0, $capped);
        }
        return $capped * self::ONE_MILLISECOND;
    }

    private function sleepMicroseconds(int $microseconds): void
    {
        if ($microseconds > 0) {
            usleep($microseconds);
        }
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

    private function isApiError(int $status_code): bool
    {
        return $status_code < 200 || $status_code >= 300;
    }
}
