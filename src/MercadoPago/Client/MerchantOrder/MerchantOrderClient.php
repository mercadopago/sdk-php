<?php

namespace MercadoPago\Client\MerchantOrder;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\MerchantOrder;
use MercadoPago\Resources\MerchantOrderSearch;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing merchant order actions. */
final class MerchantOrderClient extends MercadoPagoClient
{
    private const URL = "/merchant_orders";

    private const URL_WITH_ID = "/merchant_orders/%s";

    private const URL_SEARCH = "/merchant_orders/search";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating merchant order.
     * @param array $request merchant order data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\MerchantOrder merchant order created.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(array $request, ?MPRequestOptions $request_options = null): MerchantOrder
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(MerchantOrder::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting merchant order.
     * @param int $id merchant order id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\MerchantOrder merchant order found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function get(int $id, ?MPRequestOptions $request_options = null): MerchantOrder
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, strval($id)), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(MerchantOrder::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for update merchant order.
     * @param int $id merchant order id.
     * @param array $request merchant order data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\MerchantOrder merchant order updated.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function update(int $id, array $request, ?MPRequestOptions $request_options = null): MerchantOrder
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, strval($id)), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(MerchantOrder::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for search merchant orders.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\MerchantOrderSearch search results.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function search(MPSearchRequest $request, ?MPRequestOptions $request_options = null): MerchantOrderSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(MerchantOrderSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
