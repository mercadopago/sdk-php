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

/** Client responsible for performing preference actions. */
final class PreferenceClient extends MercadoPagoClient
{
    private const URL = "/checkout/preferences";

    private const URL_WITH_ID = "/checkout/preferences/%s";

    private const URL_SEARCH = "/checkout/preferences/search";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating preference.
     * @param array $request preference data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Preference preference created.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(array $request, ?RequestOptions $request_options = null): Preference
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Preference::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting preference.
     * @param string $id preference ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Preference preference found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function get(string $id, ?RequestOptions $request_options = null): Preference
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Preference::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for update preference.
     * @param string $id preference ID.
     * @param array $request preference data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Preference preference canceled.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function update(string $id, array $request, ?RequestOptions $request_options = null): Preference
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Preference::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for search preferences.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PreferenceSearch search results.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
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
