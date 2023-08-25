<?php

namespace MercadoPago\Client\Preference;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\Preference;
use MercadoPago\Resources\PreferenceSearch;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing preference actions. */
class PreferenceClient extends MercadoPagoClient
{
    private static $URL = "/checkout/preferences";

    private static $URL_WITH_ID = "/checkout/preferences/%s";

    private static $URL_SEARCH = "/checkout/preferences/search";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating preference.
     * @param array $request preference data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Preference preference created.
     */
    public function create(array $request, ?MPRequestOptions $request_options = null): Preference
    {
        try {
            $response = parent::send(self::$URL, HttpMethod::POST, json_encode($request), null, $request_options);
            $result = Serializer::deserializeFromJson(Preference::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for getting preference.
     * @param string $id preference id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Preference preference found.
     */
    public function get(string $id, ?MPRequestOptions $request_options = null): Preference
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
            $result = Serializer::deserializeFromJson(Preference::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for update preference.
     * @param string $id preference id.
     * @param array $request preference data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Preference preference canceled.
     */
    public function update(string $id, array $request, ?MPRequestOptions $request_options = null): Preference
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
            $result = Serializer::deserializeFromJson(Preference::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     *  Method responsible for search preferences.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\PreferenceSearch search results.
     */
    public function search(MPSearchRequest $request, ?MPRequestOptions $request_options = null): PreferenceSearch
    {
        try {
            $query_params = isset($request) ? $request->getParameters() : null;
            $response = parent::send(self::$URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
            $result = Serializer::deserializeFromJson(PreferenceSearch::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }
}
