<?php

namespace MercadoPago\Client\PreApproval;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\PreApproval;
use MercadoPago\Resources\PreApprovalSearch;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Subscriptions (Pre-Approval) API (`/preapproval`).
 *
 * Manages recurring payment subscriptions where the buyer authorizes
 * automatic charges on a defined schedule (monthly, yearly, etc.).
 *
 * @see https://www.mercadopago.com/developers/en/reference/subscriptions/_preapproval/post
 */
final class PreApprovalClient extends MercadoPagoClient
{
    private const URL = "/preapproval";

    private const URL_WITH_ID = "/preapproval/%s";

    private const URL_SEARCH = "/preapproval/search";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a new subscription (pre-approval).
     *
     * @param array<string,mixed> $request Subscription data (payer_email, auto_recurring, back_url, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PreApproval The created subscription resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function create(array $request, ?RequestOptions $request_options = null): PreApproval
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PreApproval::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Retrieves a subscription by its ID.
     *
     * @param string $id Subscription (pre-approval) ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PreApproval The found subscription resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function get(string $id, ?RequestOptions $request_options = null): PreApproval
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PreApproval::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
    /**
     * Updates an existing subscription.
     *
     * @param string $id Subscription (pre-approval) ID.
     * @param array<string,mixed> $request Fields to update (status, auto_recurring, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PreApproval The updated subscription resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function update(string $id, array $request, ?RequestOptions $request_options = null): PreApproval
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PreApproval::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Searches subscriptions with pagination and filters.
     *
     * @param MPSearchRequest $request Search criteria (limit, offset, filters like status, payer_id).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PreApprovalSearch Paginated search results.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function search(MPSearchRequest $request, ?RequestOptions $request_options = null): PreApprovalSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(PreApprovalSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
