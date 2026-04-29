<?php

namespace MercadoPago\Client\Order;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Resources\Order;
use MercadoPago\Resources\OrderSearch;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Orders API (`/v1/orders`).
 *
 * Provides full lifecycle management for orders: create, get, capture, cancel,
 * process, refund, and search. Transaction-level operations (add/update/delete
 * individual payments) are handled by the dedicated {@see OrderTransactionClient}.
 *
 * @see https://www.mercadopago.com/developers/en/reference/order/_v1_orders/post
 */
final class OrderClient extends MercadoPagoClient
{
    private const URL = "/v1/orders";
    private const URL_WITH_ID = "/v1/orders/%s";
    private const URL_SEARCH = "/v1/orders";
    private const URL_CAPTURE = self::URL_WITH_ID . '/capture';
    private const URL_CANCEL = self::URL_WITH_ID . '/cancel';
    private const URL_PROCESS = self::URL_WITH_ID . '/process';
    private const URL_REFUND = self::URL_WITH_ID . '/refund';

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a new order.
     *
     * @param array<string,mixed> $request Order data (type, total_amount, external_reference, payer, transactions, items, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Order The created order resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/order/_v1_orders/post
     */
    public function create(array $request, ?RequestOptions $request_options = null): Order
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(Order::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Captures an authorized order.
     *
     * Only applies to orders created with `capture_mode: "manual"`. Once captured,
     * the funds are transferred from the buyer to the seller.
     *
     * @param string $order_id Unique identifier of the order to capture.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Order The captured order resource with updated status.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/order/_v1_orders_id_capture/post
     */
    public function capture(string $order_id, ?RequestOptions $request_options = null): Order
    {
        $response = parent::send(sprintf(self::URL_CAPTURE, $order_id), HttpMethod::POST, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Order::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Retrieves an existing order by its ID.
     *
     * @param string $order_id Unique identifier of the order.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Order The found order resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/order/_v1_orders_id/get
     */
    public function get(string $order_id, ?RequestOptions $request_options = null): Order
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $order_id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Order::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Cancels an existing order.
     *
     * Only orders that have not yet been fully captured can be cancelled.
     * Cancellation releases any authorized funds back to the buyer.
     *
     * @param string $order_id Unique identifier of the order to cancel.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Order The cancelled order resource with updated status.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/order/_v1_orders_id_cancel/post
     */
    public function cancel(string $order_id, ?RequestOptions $request_options = null): Order
    {
        $response = parent::send(sprintf(self::URL_CANCEL, $order_id), HttpMethod::POST, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Order::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Processes an order, triggering its payment execution.
     *
     * Initiates the payment flow for all transactions attached to the order.
     * The order must have at least one transaction configured before processing.
     *
     * @param string $order_id Unique identifier of the order to process.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Order The processed order resource with updated status.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/order/_v1_orders_id_process/post
     */
    public function process(string $order_id, ?RequestOptions $request_options = null): Order
    {
        $response = parent::send(sprintf(self::URL_PROCESS, $order_id), HttpMethod::POST, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Order::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Refunds an order (total or partial).
     *
     * Pass null for the request to perform a total refund of the entire order amount.
     * For partial refunds, provide an array with the desired refund details (e.g., transactions to refund).
     *
     * @param string $order_id Unique identifier of the order to refund.
     * @param array<string,mixed>|null $request Refund data for partial refunds, or null for a total refund.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Order The refunded order resource with updated refund details.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/order/_v1_orders_id_refund/post
     */
    public function refund(string $order_id, ?array $request = null, ?RequestOptions $request_options = null): Order
    {
        $path = sprintf(self::URL_REFUND, $order_id);
        if ($request !== null) {
            $request = json_encode($request);
        }
        $response = parent::send($path, HttpMethod::POST, $request, null, $request_options);
        $result = Serializer::deserializeFromJson(Order::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Searches orders with pagination and filters.
     *
     * @param MPSearchRequest $request Search criteria (limit, offset, filters like status, external_reference, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return OrderSearch Paginated search results containing matching orders.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com/developers/en/reference/order/_v1_orders_search/get
     */
    public function search(MPSearchRequest $request, ?RequestOptions $request_options = null): OrderSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(OrderSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
