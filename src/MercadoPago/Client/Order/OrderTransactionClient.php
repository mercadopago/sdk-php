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

/**
 * Client for the Order Transactions API (`/v1/orders/{id}/transactions`).
 *
 * Manages payment transactions within an order, supporting multi-payment
 * scenarios where an order can contain multiple transactions (split payments).
 */
final class OrderTransactionClient extends MercadoPagoClient
{
    private const URL = "/v1/orders/%s/transactions";
    private const URL_WITH_ID = self::URL . "/%s";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a new transaction within an order.
     *
     * @param string $order_id Order ID.
     * @param array<string,mixed> $request Transaction data (payment method, amount, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Transactions The created transaction resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
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
     * Updates an existing transaction within an order.
     *
     * @param string $order_id Order ID.
     * @param string $transaction_id Transaction ID to update.
     * @param array<string,mixed> $request Fields to update.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return UpdateTransaction The updated transaction resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
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
     * Deletes a transaction from an order.
     *
     * @param string $order_id Order ID.
     * @param string $transaction_id Transaction ID to delete.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return MPResponse Raw API response (typically empty body with 204 status).
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function delete(string $order_id, string $transaction_id, ?RequestOptions $request_options = null): MPResponse
    {
        $path = sprintf(self::URL_WITH_ID, $order_id, $transaction_id);
        return parent::send($path, HttpMethod::DELETE, null, null, $request_options);
    }
}
