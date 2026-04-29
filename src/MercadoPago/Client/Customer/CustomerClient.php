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

/**
 * Client for the Customers API (`/v1/customers`).
 *
 * Manages customer records used to store payer information, saved cards,
 * and addresses for streamlined checkout experiences.
 *
 * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/customers/create-customer/post
 */
final class CustomerClient extends MercadoPagoClient
{
    private const URL = "/v1/customers";

    private const URL_WITH_ID = "/v1/customers/%s";

    private const URL_SEARCH = "/v1/customers/search";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a new customer from a data array.
     *
     * @param array<string,mixed> $request Customer data (email, first_name, last_name, identification, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Customer The created customer resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/customers/create-customer/post
     */
    public function create(array $request, ?RequestOptions $request_options = null): Customer
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Customer::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Creates a new customer using only an email address.
     *
     * Convenience shortcut for {@see create()} when only the email is known.
     *
     * @param string $email Customer's email address.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Customer The created customer resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/customers/create-customer/post
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
     * Retrieves an existing customer by ID.
     *
     * @param string $id Customer ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Customer The found customer resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/customers/get-customer/get
     */
    public function get(string $id, ?RequestOptions $request_options = null): Customer
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Customer::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Updates an existing customer's data.
     *
     * @param string $id Customer ID.
     * @param array<string,mixed> $request Fields to update.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Customer The updated customer resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/customers/update-customer/put
     */
    public function update(string $id, array $request, ?RequestOptions $request_options = null): Customer
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Customer::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Searches customers with pagination and filters.
     *
     * @param MPSearchRequest|null $request Search criteria (limit, offset, filters like email).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return CustomerSearch Paginated search results containing matching customers.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/customers/search-customer/get
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
