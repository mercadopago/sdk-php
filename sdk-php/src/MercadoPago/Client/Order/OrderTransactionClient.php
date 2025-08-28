<?php

namespace MercadoPago\Client\Order;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\Order\Transaction\UpdateTransaction;
use MercadoPago\Resources\Order\Transactions;
use MercadoPago\Serialization\Serializer;
use MercadoPago\Net\MPResponse;

/** Client responsible for performing Order transactions actions. */
final class OrderTransactionClient extends MercadoPagoClient
{
    private const URL = "/v1/orders/%s/transactions";
    private const URL_WITH_ID = self::URL . "/%s";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating transactions for an Order.
     * @param string $order_id Order ID.
     * @param array $request Create Transaction request.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Order\Transactions Transaction created.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(string $order_id, array $request, ?RequestOptions $request_options = null): Transactions
    {
        $path = sprintf(self::URL, $order_id);
        $response = parent::send($path, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Transactions::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for updating an Order transaction.
     * @param string $order_id Order ID.
     * @param string $transaction_id Transaction ID.
     * @param array $request Update Transaction request.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Order\UpdateTransaction Transaction updated.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function update(string $order_id, string $transaction_id, array $request, ?RequestOptions $request_options = null): UpdateTransaction
    {
        $path = sprintf(self::URL_WITH_ID, $order_id, $transaction_id);
        $response = parent::send($path, HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(UpdateTransaction::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for deleting a transaction of an Order.
     * @param string $order_id Order ID.
     * @param string $transaction_id Transaction ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return Response
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function delete(string $order_id, string $transaction_id, ?RequestOptions $request_options = null): MPResponse
    {
        $path = sprintf(self::URL_WITH_ID, $order_id, $transaction_id);
        return parent::send($path, HttpMethod::DELETE, null, null, $request_options);
    }
}
