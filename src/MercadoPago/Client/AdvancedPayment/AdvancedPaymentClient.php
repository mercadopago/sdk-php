<?php

namespace MercadoPago\Client\AdvancedPayment;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\AdvancedPayment;
use MercadoPago\Resources\AdvancedPaymentSearch;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Advanced Payments (Marketplace Split Payments) API (`/v1/advanced_payments`).
 *
 * Enables marketplace integrations to collect a single payment and split it among
 * multiple sellers (disbursements). Supports two-step flows (authorise → capture)
 * and individual disbursement release-date control.
 *
 * @see https://www.mercadopago.com/developers/en/reference
 */
final class AdvancedPaymentClient extends MercadoPagoClient
{
    private const URL = "/v1/advanced_payments";

    private const URL_WITH_ID = "/v1/advanced_payments/%s";

    private const URL_SEARCH = "/v1/advanced_payments/search";

    private const URL_DISBURSES = "/v1/advanced_payments/%s/disburses";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a new advanced (split) payment.
     *
     * @param array<string,mixed> $request Advanced payment data including payments, disbursements, and payer.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return AdvancedPayment The created advanced payment resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function create(array $request, ?RequestOptions $request_options = null): AdvancedPayment
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(AdvancedPayment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Retrieves an advanced payment by its ID.
     *
     * @param int $id Advanced payment ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return AdvancedPayment The found advanced payment resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function get(int $id, ?RequestOptions $request_options = null): AdvancedPayment
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(AdvancedPayment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Searches advanced payments with pagination and filters.
     *
     * @param MPSearchRequest $request Search criteria.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return AdvancedPaymentSearch Paginated search results.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function search(MPSearchRequest $request, ?RequestOptions $request_options = null): AdvancedPaymentSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(AdvancedPaymentSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Updates an existing advanced payment.
     *
     * @param int $id Advanced payment ID.
     * @param array<string,mixed> $request Fields to update.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return AdvancedPayment The updated advanced payment resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function update(int $id, array $request, ?RequestOptions $request_options = null): AdvancedPayment
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(AdvancedPayment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Captures a previously authorised advanced payment.
     *
     * Sends `{"capture": true}` to finalise a two-step payment flow.
     *
     * @param int $id Advanced payment ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return AdvancedPayment The captured advanced payment resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function capture(int $id, ?RequestOptions $request_options = null): AdvancedPayment
    {
        $payload = ["capture" => true];
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::PUT, json_encode($payload), null, $request_options);
        $result = Serializer::deserializeFromJson(AdvancedPayment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Cancels an advanced payment by setting its status to "cancelled".
     *
     * Only payments that have not yet been captured can be cancelled.
     *
     * @param int $id Advanced payment ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return AdvancedPayment The cancelled advanced payment resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function cancel(int $id, ?RequestOptions $request_options = null): AdvancedPayment
    {
        $payload = ["status" => "cancelled"];
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::PUT, json_encode($payload), null, $request_options);
        $result = Serializer::deserializeFromJson(AdvancedPayment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Changes the money release date for all disbursements of an advanced payment.
     *
     * Allows the marketplace to control when funds become available to sellers.
     *
     * @param int $id Advanced payment ID.
     * @param string $release_date New release date in ISO 8601 format (e.g. "2025-12-31 00:00:00.000").
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return AdvancedPayment The updated advanced payment resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function updateReleaseDate(int $id, string $release_date, ?RequestOptions $request_options = null): AdvancedPayment
    {
        $payload = ["money_release_date" => $release_date];
        $response = parent::send(sprintf(self::URL_DISBURSES, $id), HttpMethod::POST, json_encode($payload), null, $request_options);
        $result = Serializer::deserializeFromJson(AdvancedPayment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
