<?php

namespace MercadoPago\Client\Customer;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\Customer;
use MercadoPago\Resources\CustomerSearch;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing customer actions. */
final class CustomerClient extends MercadoPagoClient
{
    private const URL = "/v1/customers";

    private const URL_WITH_ID = "/v1/customers/%s";

    private const URL_SEARCH = "/v1/customers/search";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for save Customer.
     * @param array $request customer data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Customer save.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(array $request, ?RequestOptions $request_options = null): Customer
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Customer::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for save Customer.
     * @param string $email customer email.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Customer save.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function createByEmail(string $email, ?RequestOptions $request_options = null): Customer
    {
        $request = new CustomerCreateRequest();
        $request->email = $email;
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Customer::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting Customer.
     * @param string $id customer ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Customer found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function get(string $id, ?RequestOptions $request_options = null): Customer
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Customer::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for update Customer.
     * @param string $id customer ID.
     * @param array $request customer data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Customer update.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function update(string $id, array $request, ?RequestOptions $request_options = null): Customer
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Customer::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     *  Method responsible for search customers.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\CustomerSearch search results.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function search(?MPSearchRequest $request  = null, ?RequestOptions $request_options = null): CustomerSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(CustomerSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
