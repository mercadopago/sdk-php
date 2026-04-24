<?php

namespace MercadoPago\Client\Payment;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\Payment;
use MercadoPago\Resources\PaymentSearch;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Payments API (`/v1/payments`).
 *
 * Provides CRUD operations for payments: create, get, cancel, capture, and search.
 * Refund operations are handled by the dedicated {@see PaymentRefundClient}.
 *
 * @see https://www.mercadopago.com/developers/en/reference/payments/_payments/post
 */
final class PaymentClient extends MercadoPagoClient
{
    private const URL = "/v1/payments";

    private const URL_WITH_ID = "/v1/payments/%s";

    private const URL_SEARCH = "/v1/payments/search";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a new payment.
     *
     * @param array<string,mixed> $request Payment data (transaction_amount, token, payment_method_id, payer, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Payment The created payment resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function create(array $request, ?RequestOptions $request_options = null): Payment
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Payment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Retrieves an existing payment by its ID.
     *
     * @param int $id Payment ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Payment The found payment resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function get(int $id, ?RequestOptions $request_options = null): Payment
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, strval($id)), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Payment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
    /**
     * Cancels a pending payment by setting its status to "cancelled".
     *
     * Only payments in "pending" status can be cancelled.
     *
     * @param int $id Payment ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Payment The cancelled payment resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function cancel(int $id, ?RequestOptions $request_options = null): Payment
    {
        $payload = new PaymentCancelRequest();
        $response = parent::send(sprintf(self::URL_WITH_ID, strval($id)), HttpMethod::PUT, json_encode($payload), null, $request_options);
        $result = Serializer::deserializeFromJson(Payment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Captures an authorized payment (full or partial).
     *
     * Only applies to payments created with `capture: false`. Pass null for the amount
     * to capture the full authorized amount, or a specific value for partial capture.
     *
     * @param int $id Payment ID.
     * @param float|null $amount Amount to capture. Null captures the full authorized amount.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Payment The captured payment resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function capture(int $id, ?float $amount, ?RequestOptions $request_options = null): Payment
    {
        $payload = new PaymentCaptureRequest();
        $payload->transaction_amount = $amount;
        $response = parent::send(sprintf(self::URL_WITH_ID, strval($id)), HttpMethod::PUT, json_encode($payload), null, $request_options);
        $result = Serializer::deserializeFromJson(Payment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Searches payments with pagination and filters.
     *
     * @param MPSearchRequest $request Search criteria (limit, offset, filters like status, date_created, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PaymentSearch Paginated search results containing matching payments.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function search(MPSearchRequest $request, ?RequestOptions $request_options = null): PaymentSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(PaymentSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
