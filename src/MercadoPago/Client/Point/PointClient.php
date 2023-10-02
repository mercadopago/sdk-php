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

/** Client responsible for performing preference actions. */
final class PointClient extends MercadoPagoClient
{
    private const PAYMENT_INTENT_URL = "/point/integration-api/devices/%s/payment-intents";

    private const PAYMENT_INTENT_SEARCH_URL = "/point/integration-api/payment-intents/%s";

    private const PAYMENT_INTENT_LIST_URL = "/point/integration-api/payment-intents/events";

    private const PAYMENT_INTENT_DELETE_URL = "/point/integration-api/devices/%s/payment-intents/%s";

    private const PAYMENT_INTENT_STATUS_URL = "/point/integration-api/payment-intents/%s/events";

    private const DEVICES_URL = "/point/integration-api/devices";

    private const DEVICE_WITH_ID_URL = "/point/integration-api/devices/%s";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating a payment intent.
     * @param string $device_id device ID.
     * @param array $request payment intent data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentIntent payment intent created.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function createPaymentIntent(string $device_id, array $request, ?RequestOptions $request_options = null): PaymentIntent
    {
        $response = parent::send(sprintf(self::PAYMENT_INTENT_URL, $device_id), HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentIntent::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for searching a payment intent.
     * @param string $payment_intent_id payment intent ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentIntent payment intent found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function searchPaymentIntent(string $payment_intent_id, ?RequestOptions $request_options = null): PaymentIntent
    {
        $response = parent::send(sprintf(self::PAYMENT_INTENT_SEARCH_URL, $payment_intent_id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentIntent::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for canceling a payment intent.
     * @param string $device_id device ID.
     * @param string $payment_intent_id payment intent ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentIntentCancel payment intent canceled.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function cancelPaymentIntent(string $device_id, string $payment_intent_id, ?RequestOptions $request_options = null): PaymentIntentCancel
    {
        $response = parent::send(sprintf(self::PAYMENT_INTENT_DELETE_URL, $device_id, $payment_intent_id), HttpMethod::DELETE, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentIntentCancel::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting payment intent list.
     * @param \MercadoPago\Client\Point\PointPaymentIntentListRequest $request payment intent list request.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentIntentList payment intent list.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function getPaymentIntentList(PointPaymentIntentListRequest $request, ?RequestOptions $request_options = null): PaymentIntentList
    {
        $response = parent::send(self::PAYMENT_INTENT_LIST_URL, HttpMethod::GET, null, $request->getParameters(), $request_options);
        $result = Serializer::deserializeFromJson(PaymentIntentList::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting payment intent status.
     * @param string $payment_intent_id payment intent ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentIntentStatus payment intent status.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function getPaymentIntentStatus(string $payment_intent_id, ?RequestOptions $request_options = null): PaymentIntentStatus
    {
        $response = parent::send(sprintf(self::PAYMENT_INTENT_STATUS_URL, $payment_intent_id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentIntentStatus::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting devices.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PointDevices devices found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
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
     * Method responsible for changing the device operating mode.
     * @param string $device_id device ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PointDeviceOperatingMode device operating mode.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function changeDeviceOperatingMode(string $device_id, PointDeviceOperatingModeRequest $request, ?RequestOptions $request_options = null): PointDeviceOperatingMode
    {
        $response = parent::send(sprintf(self::DEVICE_WITH_ID_URL, $device_id), HttpMethod::PATCH, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PointDeviceOperatingMode::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
