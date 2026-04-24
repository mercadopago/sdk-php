<?php

namespace MercadoPago\Client\Preference;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\Preference;
use MercadoPago\Resources\PreferenceSearch;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Checkout Preferences API (`/checkout/preferences`).
 *
 * Preferences define the items, amounts, and configuration for a Checkout Pro
 * payment flow. Creating a preference returns URLs (init_point, sandbox_init_point)
 * to redirect the buyer to MercadoPago's hosted checkout.
 *
 * @see https://www.mercadopago.com/developers/en/reference/preferences/_checkout_preferences/post
 */
final class PreferenceClient extends MercadoPagoClient
{
    private const URL = "/checkout/preferences";

    private const URL_WITH_ID = "/checkout/preferences/%s";

    private const URL_SEARCH = "/checkout/preferences/search";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a new checkout preference.
     *
     * @param array<string,mixed> $request Preference data (items, payer, back_urls, payment_methods, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Preference The created preference with init_point URLs.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function create(array $request, ?RequestOptions $request_options = null): Preference
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Preference::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Retrieves a preference by its ID.
     *
     * @param string $id Preference ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Preference The found preference resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function get(string $id, ?RequestOptions $request_options = null): Preference
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Preference::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Updates an existing preference.
     *
     * @param string $id Preference ID.
     * @param array<string,mixed> $request Fields to update.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Preference The updated preference resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function update(string $id, array $request, ?RequestOptions $request_options = null): Preference
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Preference::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Searches preferences with pagination and filters.
     *
     * @param MPSearchRequest $request Search criteria (limit, offset, filters).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PreferenceSearch Paginated search results.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function search(MPSearchRequest $request, ?RequestOptions $request_options = null): PreferenceSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(PreferenceSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
