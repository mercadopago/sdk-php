<?php

namespace MercadoPago\Client\Customer;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\CustomerCard;
use MercadoPago\Resources\CustomerCardResult;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Customer Cards API (`/v1/customers/{id}/cards`).
 *
 * Manages saved payment cards associated with a customer, enabling
 * one-click checkout experiences without re-entering card details.
 *
 * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/cards/save-card/post
 */
final class CustomerCardClient extends MercadoPagoClient
{
    private const URL_CUSTOMER_ID = "/v1/customers/%s/cards";

    private const URL_CUSTOMER_ID_AND_CARD_ID = "/v1/customers/%s/cards/%s";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Saves a new card for a customer using a card token.
     *
     * @param string $customer_id Customer ID.
     * @param array<string,mixed> $request Card data (token is required).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return CustomerCard The saved card resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/cards/save-card/post
     */
    public function create(string $customer_id, array $request, ?RequestOptions $request_options = null): CustomerCard
    {
        $response = parent::send(sprintf(self::URL_CUSTOMER_ID, $customer_id), HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Retrieves a specific saved card for a customer.
     *
     * @param string $customer_id Customer ID.
     * @param string $card_id Card ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return CustomerCard The found card resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/cards/get-card/get
     */
    public function get(string $customer_id, string $card_id, ?RequestOptions $request_options = null): CustomerCard
    {
        $response = parent::send(sprintf(self::URL_CUSTOMER_ID_AND_CARD_ID, $customer_id, $card_id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
    /**
     * Updates a saved card's data (e.g., expiration date).
     *
     * @param string $customer_id Customer ID.
     * @param string $card_id Card ID.
     * @param array<string,mixed> $request Fields to update.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return CustomerCard The updated card resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/cards/update-card/put
     */
    public function update(string $customer_id, string $card_id, array $request, ?RequestOptions $request_options = null): CustomerCard
    {
        $response = parent::send(sprintf(self::URL_CUSTOMER_ID_AND_CARD_ID, $customer_id, $card_id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Deletes a saved card from a customer's account.
     *
     * @param string $customer_id Customer ID.
     * @param string $card_id Card ID to delete.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return CustomerCard The deleted card resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/cards/delete-card/delete
     */
    public function delete(string $customer_id, string $card_id, ?RequestOptions $request_options = null): CustomerCard
    {
        $response = parent::send(sprintf(self::URL_CUSTOMER_ID_AND_CARD_ID, $customer_id, $card_id), HttpMethod::DELETE, null, null, $request_options);
        $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Lists all saved cards for a customer.
     *
     * @param string $customer_id Customer ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return CustomerCardResult Collection of saved card resources.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/online-payments/checkout-api/cards/get-customer-cards/get
     */
    public function list(string $customer_id, ?RequestOptions $request_options = null): CustomerCardResult
    {
        $response = parent::send(sprintf(self::URL_CUSTOMER_ID, $customer_id), HttpMethod::GET, null, null, $request_options);
        $result_data = array("data" => $response->getContent());
        $result = Serializer::deserializeFromJson(CustomerCardResult::class, $result_data);
        $result->setResponse($response);
        return $result;
    }
}
