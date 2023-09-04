<?php

namespace MercadoPago\Client\Customer;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\Customer;
use MercadoPago\Resources\CustomerSearch;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing customer actions. */
class CustomerClient extends MercadoPagoClient
{
    private static $URL = "/v1/customers";

    private static $URL_WITH_ID = "/v1/customers/%s";

    private static $URL_SEARCH = "/v1/customers/search";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for save Customer.
     * @param array $request customer data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Customer save.
     */
    public function create(array $request, ?MPRequestOptions $request_options = null): Customer
    {
        try {
            $response = parent::send(self::$URL, HttpMethod::POST, json_encode($request), null, $request_options);
            $result = Serializer::deserializeFromJson(Customer::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for save Customer.
     * @param string $email customer email.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Customer save.
     */
    public function createByEmail(string $email, ?MPRequestOptions $request_options = null): Customer
    {
        try {
            $request = new CustomerCreateRequest();
            $request->email = $email;
            $response = parent::send(self::$URL, HttpMethod::POST, json_encode($request), null, $request_options);
            $result = Serializer::deserializeFromJson(Customer::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for getting Customer.
     * @param string $id customer id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Customer found.
     */
    public function get(string $id, ?MPRequestOptions $request_options = null): Customer
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
            $result = Serializer::deserializeFromJson(Customer::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for update Customer.
     * @param string $id customer id.
     * @param array $request customer data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Customer update.
     */
    public function update(string $id, array $request, ?MPRequestOptions $request_options = null): Customer
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
            $result = Serializer::deserializeFromJson(Customer::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     *  Method responsible for search customers.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\CustomerSearch search results.
     */
    public function search(?MPSearchRequest $request  = null, ?MPRequestOptions $request_options = null): CustomerSearch
    {
        try {
            $query_params = isset($request) ? $request->getParameters() : null;
            $response = parent::send(self::$URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
            $result = Serializer::deserializeFromJson(CustomerSearch::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }
}
