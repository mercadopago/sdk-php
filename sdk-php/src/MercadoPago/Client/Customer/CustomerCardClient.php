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

/** Client responsible for performing customer card actions. */
final class CustomerCardClient extends MercadoPagoClient
{
    private const URL_CUSTOMER_ID = "/v1/customers/%s/cards";

    private const URL_CUSTOMER_ID_AND_CARD_ID = "/v1/customers/%s/cards/%s";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for save Customer Card.
     * @param string $customer_id customer ID.
     * @param array $request customer card data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard save.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(string $customer_id, array $request, ?RequestOptions $request_options = null): CustomerCard
    {
        $response = parent::send(sprintf(self::URL_CUSTOMER_ID, $customer_id), HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting Customer Card.
     * @param string $customer_id customer ID.
     * @param string $card_id customer card ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function get(string $customer_id, string $card_id, ?RequestOptions $request_options = null): CustomerCard
    {
        $response = parent::send(sprintf(self::URL_CUSTOMER_ID_AND_CARD_ID, $customer_id, $card_id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
    /**
     * Method responsible for update Customer Card.
     * @param string $customer_id customer ID.
     * @param string $card_id card ID.
     * @param array $request customer card data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard update.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function update(string $customer_id, string $card_id, array $request, ?RequestOptions $request_options = null): CustomerCard
    {
        $response = parent::send(sprintf(self::URL_CUSTOMER_ID_AND_CARD_ID, $customer_id, $card_id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for Customer Card deletion.
     * @param string $customer_id customer ID.
     * @param string $card_id card ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function delete(string $customer_id, string $card_id, ?RequestOptions $request_options = null): CustomerCard
    {
        $response = parent::send(sprintf(self::URL_CUSTOMER_ID_AND_CARD_ID, $customer_id, $card_id), HttpMethod::DELETE, null, null, $request_options);
        $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting list Customer Card.
     * @param string $customer_id customer ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\CustomerCardResult found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
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
