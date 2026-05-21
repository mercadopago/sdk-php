<?php

namespace MercadoPago\Client\Point;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\PaymentIntent;
use MercadoPago\Resources\PaymentIntentCancel;
use MercadoPago\Resources\PaymentIntentList;
use MercadoPago\Resources\PaymentIntentStatus;
use MercadoPago\Resources\PointDeviceOperatingMode;
use MercadoPago\Resources\PointDevices;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Point Integration API (in-person payments with MercadoPago Point devices).
 *
 * Manages payment intents (charge requests sent to Point devices), device listing,
 * and device operating mode configuration. Used for face-to-face payment scenarios.
 */
final class PointClient extends MercadoPagoClient
{
    private const PAYMENT_INTENT_URL = "/point/integration-api/devices/%s/payment-intents";

    private const PAYMENT_INTENT_SEARCH_URL = "/point/integration-api/payment-intents/%s";

    private const PAYMENT_INTENT_LIST_URL = "/point/integration-api/payment-intents/events";

    private const PAYMENT_INTENT_DELETE_URL = "/point/integration-api/devices/%s/payment-intents/%s";

    private const PAYMENT_INTENT_STATUS_URL = "/point/integration-api/payment-intents/%s/events";

    private const DEVICES_URL = "/point/integration-api/devices";

    private const DEVICE_WITH_ID_URL = "/point/integration-api/devices/%s";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a payment intent on a specific Point device.
     *
     * The device will display the payment request for the buyer to tap/swipe their card.
     *
     * @param string $device_id Target Point device ID.
     * @param array<string,mixed> $request Payment intent data (amount, description, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PaymentIntent The created payment intent resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function createPaymentIntent(string $device_id, array $request, ?RequestOptions $request_options = null): PaymentIntent
    {
        $response = parent::send(sprintf(self::PAYMENT_INTENT_URL, $device_id), HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentIntent::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Retrieves a payment intent by its ID.
     *
     * @param string $payment_intent_id Payment intent ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PaymentIntent The found payment intent resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function searchPaymentIntent(string $payment_intent_id, ?RequestOptions $request_options = null): PaymentIntent
    {
        $response = parent::send(sprintf(self::PAYMENT_INTENT_SEARCH_URL, $payment_intent_id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentIntent::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Cancels a pending payment intent on a Point device.
     *
     * @param string $device_id Device ID where the intent was sent.
     * @param string $payment_intent_id Payment intent ID to cancel.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PaymentIntentCancel Cancellation confirmation resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function cancelPaymentIntent(string $device_id, string $payment_intent_id, ?RequestOptions $request_options = null): PaymentIntentCancel
    {
        $response = parent::send(sprintf(self::PAYMENT_INTENT_DELETE_URL, $device_id, $payment_intent_id), HttpMethod::DELETE, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentIntentCancel::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Lists payment intent events within a date range.
     *
     * @param PointPaymentIntentListRequest $request Date range filter (start_date, end_date).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PaymentIntentList Paginated list of payment intent events.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function getPaymentIntentList(PointPaymentIntentListRequest $request, ?RequestOptions $request_options = null): PaymentIntentList
    {
        $response = parent::send(self::PAYMENT_INTENT_LIST_URL, HttpMethod::GET, null, $request->getParameters(), $request_options);
        $result = Serializer::deserializeFromJson(PaymentIntentList::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Retrieves the current status and event history of a payment intent.
     *
     * @param string $payment_intent_id Payment intent ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PaymentIntentStatus Status and events for the payment intent.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function getPaymentIntentStatus(string $payment_intent_id, ?RequestOptions $request_options = null): PaymentIntentStatus
    {
        $response = parent::send(sprintf(self::PAYMENT_INTENT_STATUS_URL, $payment_intent_id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentIntentStatus::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Lists Point devices associated with the account.
     *
     * @param MPSearchRequest $request Search criteria (pagination and filters).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PointDevices Collection of Point device resources.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function getDevices(MPSearchRequest $request, ?RequestOptions $request_options = null): PointDevices
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::DEVICES_URL, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(PointDevices::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Changes the operating mode of a Point device (e.g., PDV, STANDALONE).
     *
     * @param string $device_id Device ID.
     * @param PointDeviceOperatingModeRequest $request New operating mode configuration.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PointDeviceOperatingMode Updated device operating mode resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function changeDeviceOperatingMode(string $device_id, PointDeviceOperatingModeRequest $request, ?RequestOptions $request_options = null): PointDeviceOperatingMode
    {
        $response = parent::send(sprintf(self::DEVICE_WITH_ID_URL, $device_id), HttpMethod::PATCH, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PointDeviceOperatingMode::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
