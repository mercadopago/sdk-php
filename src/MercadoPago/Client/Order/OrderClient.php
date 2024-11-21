<?php

namespace MercadoPago\Client\Order;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Resources\Order;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing Order actions. */
final class OrderClient extends MercadoPagoClient
{
    private const URL = "/v1/orders";
    private const URL_CAPTURE = "/v1/orders/%s/capture";
    private const URL_WITH_ID = "/v1/orders/%s";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating Order.
     * @param array $request Order data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Order Order created.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(array $request, ?RequestOptions $request_options = null): Order
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Order::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for capturing an Order.
     * @param string $order_id Order ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Order Order created.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function capture(string $order_id, ?RequestOptions $request_options = null): Order
    {
        $response = parent::send(sprintf(self::URL_CAPTURE, $order_id), HttpMethod::POST, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Order::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for obtaining Order by ID
     *
     * @param string $order_id Order ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Order Order obtained
     * @throws \MercadoPago\Exceptions\MPApiException an error if the request fails.
     * * @throws \Exception an error if the request fails.
     */
    public function get(string $order_id, ?RequestOptions $request_options = null): Order
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $order_id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Order::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
