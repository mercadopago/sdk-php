<?php

namespace MercadoPago\Client\Customer;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Resources\CustomerCard;
use MercadoPago\Resources\CustomerCardResult;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing customer card actions. */
class CustomerCardClient extends MercadoPagoClient
{
    private static $URL_CUSTOMER_ID = "/v1/customers/%s/cards";

    private static $URL_CUSTOMER_ID_AND_CARD_ID = "/v1/customers/%s/cards/%s";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for save Customer Card.
     * @param string $customer_id customer id.
     * @param array $request customer card data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard save.
     */
    public function create(string $customer_id, array $request, ?MPRequestOptions $request_options = null): CustomerCard
    {
        try {
            $response = parent::send(sprintf(self::$URL_CUSTOMER_ID, $customer_id), HttpMethod::POST, json_encode($request), null, $request_options);
            $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for getting Customer Card.
     * @param string $customer_id customer id.
     * @param string $card_id customer card id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard found.
     */
    public function get(string $customer_id, string $card_id, ?MPRequestOptions $request_options = null): CustomerCard
    {
        try {
            $response = parent::send(sprintf(self::$URL_CUSTOMER_ID_AND_CARD_ID, $customer_id, $card_id), HttpMethod::GET, null, null, $request_options);
            $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for update Customer Card.
     * @param string $customer_id customer id.
     * @param string $card_id card id.
     * @param array $request customer card data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard update.
     */
    public function update(string $customer_id, string $card_id, array $request, ?MPRequestOptions $request_options = null): CustomerCard
    {
        try {
            $response = parent::send(sprintf(self::$URL_CUSTOMER_ID_AND_CARD_ID, $customer_id, $card_id), HttpMethod::PUT, json_encode($request), null, $request_options);
            $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for Customer Card deletion.
     * @param string $customer_id customer id.
     * @param string $card_id card id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\CustomerCard found.
     */
    public function delete(string $customer_id, string $card_id, ?MPRequestOptions $request_options = null): CustomerCard
    {
        try {
            $response = parent::send(sprintf(self::$URL_CUSTOMER_ID_AND_CARD_ID, $customer_id, $card_id), HttpMethod::DELETE, null, null, $request_options);
            $result = Serializer::deserializeFromJson(CustomerCard::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for getting list Customer Card.
     * @param string $customer_id customer id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\CustomerCardResult found.
     */
    public function list(string $customer_id, ?MPRequestOptions $request_options = null): CustomerCardResult
    {
        try {
            $response = parent::send(sprintf(self::$URL_CUSTOMER_ID, $customer_id), HttpMethod::GET, null, null, $request_options);
            $result = new CustomerCardResult();
            $result-> data = $response -> getContent();
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }
}
