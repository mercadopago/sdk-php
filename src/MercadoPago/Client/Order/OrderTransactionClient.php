<?php

namespace MercadoPago\Client\Order;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Client\Order\Transaction\CreateTransactionRequest;
use MercadoPago\Client\Order\Transaction\TransactionResponse;
use MercadoPago\Client\Order\Transaction\UpdateTransactionRequest;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\Order\Transaction\UpdateTransaction;

use MercadoPago\Serialization\Serializer;

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
     * @param \MercadoPago\Client\Order\CreateTransactionRequest $request Create Transaction request.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Client\Order\TransactionResponse Transaction created.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(string $order_id, CreateTransactionRequest $request, ?RequestOptions $request_options = null): TransactionResponse
    {
        $path = sprintf(self::URL, $order_id);
        $response = parent::send($path, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(TransactionResponse::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for updating an Order transaction.
     * @param string $order_id Order ID.
     * @param string $transaction_id Transaction ID.
     * @param \MercadoPago\Client\Order\UpdateTransaction $request Update Transaction request.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Client\Order\UpdateTransaction Transaction updated.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function update(string $order_id, string $transaction_id, UpdateTransactionRequest $request, ?RequestOptions $request_options = null): UpdateTransaction
    {
        $path = sprintf(self::URL_WITH_ID, $order_id, $transaction_id);
        $response = parent::send($path, HttpMethod::PATCH, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(UpdateTransaction::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
