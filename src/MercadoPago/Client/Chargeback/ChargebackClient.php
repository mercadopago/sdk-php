<?php

namespace MercadoPago\Client\Chargeback;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\Chargeback;
use MercadoPago\Resources\ChargebackSearch;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the MercadoPago Chargebacks API (`/v1/chargebacks`).
 *
 * Provides read-only access to chargeback dispute records initiated by
 * cardholders through their issuing bank.
 *
 * @see https://www.mercadopago.com.br/developers/en/reference/chargebacks/
 */
final class ChargebackClient extends MercadoPagoClient
{
    private const URL_WITH_ID = "/v1/chargebacks/%s";

    private const URL_SEARCH = "/v1/chargebacks/search";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Retrieves a chargeback by its ID.
     *
     * @param string $id Chargeback ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Chargeback The found chargeback resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function get(string $id, ?RequestOptions $request_options = null): Chargeback
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Chargeback::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Searches chargebacks with pagination and filters.
     *
     * @param MPSearchRequest $request Search criteria (limit, offset, filters like payment_id, status).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return ChargebackSearch Paginated search results containing matching chargebacks.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function search(MPSearchRequest $request, ?RequestOptions $request_options = null): ChargebackSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(ChargebackSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
