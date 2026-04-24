<?php

namespace MercadoPago\Client\MerchantOrder;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\MerchantOrder;
use MercadoPago\Resources\MerchantOrderSearch;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Merchant Orders API (`/merchant_orders`).
 *
 * Merchant orders group multiple payments and shipments into a single entity.
 * Commonly used with preferences to track the fulfillment status of checkout flows.
 */
final class MerchantOrderClient extends MercadoPagoClient
{
    private const URL = "/merchant_orders";

    private const URL_WITH_ID = "/merchant_orders/%s";

    private const URL_SEARCH = "/merchant_orders/search";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a new merchant order.
     *
     * @param array<string,mixed> $request Order data (items, preference_id, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return MerchantOrder The created merchant order resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function create(array $request, ?RequestOptions $request_options = null): MerchantOrder
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(MerchantOrder::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Retrieves a merchant order by its ID.
     *
     * @param int $id Merchant order ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return MerchantOrder The found merchant order resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function get(int $id, ?RequestOptions $request_options = null): MerchantOrder
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, strval($id)), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(MerchantOrder::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Updates an existing merchant order.
     *
     * @param int $id Merchant order ID.
     * @param array<string,mixed> $request Fields to update.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return MerchantOrder The updated merchant order resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function update(int $id, array $request, ?RequestOptions $request_options = null): MerchantOrder
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, strval($id)), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(MerchantOrder::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Searches merchant orders with pagination and filters.
     *
     * @param MPSearchRequest $request Search criteria (limit, offset, filters).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return MerchantOrderSearch Paginated search results.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function search(MPSearchRequest $request, ?RequestOptions $request_options = null): MerchantOrderSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(MerchantOrderSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
