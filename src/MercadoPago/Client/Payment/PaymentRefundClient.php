<?php

namespace MercadoPago\Client\Payment;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\PaymentRefund;
use MercadoPago\Resources\PaymentRefundResult;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Payment Refunds API (`/v1/payments/{id}/refunds`).
 *
 * Provides operations to create partial/total refunds, retrieve a specific refund,
 * and list all refunds for a given payment.
 *
 * @see https://www.mercadopago.com/developers/en/reference/chargebacks/_payments_id_refunds/post
 */
final class PaymentRefundClient extends MercadoPagoClient
{
    private const URL_WITH_PAYMENT_ID = "/v1/payments/%s/refunds";

    private const URL_WITH_REFUND_ID = "/v1/payments/%s/refunds/%s";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a partial refund for the specified amount.
     *
     * @param int $payment_id Payment ID to refund.
     * @param float $amount Amount to refund (must be <= remaining balance).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PaymentRefund The created refund resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com.br/developers/en/reference/chargebacks/_payments_id_refunds/post
     */
    public function refund(int $payment_id, float $amount, ?RequestOptions $request_options = null): PaymentRefund
    {
        $payload = new PaymentRefundCreateRequest();
        $payload->amount = $amount;
        $response = parent::send(sprintf(self::URL_WITH_PAYMENT_ID, strval($payment_id)), HttpMethod::POST, json_encode($payload), null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentRefund::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Creates a total refund for the full payment amount.
     *
     * @param int $payment_id Payment ID to refund.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PaymentRefund The created refund resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com.br/developers/en/reference/chargebacks/_payments_id_refunds/post
     */
    public function refundTotal(int $payment_id, ?RequestOptions $request_options = null): PaymentRefund
    {
        $response = parent::send(sprintf(self::URL_WITH_PAYMENT_ID, strval($payment_id)), HttpMethod::POST, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentRefund::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
    /**
     * Retrieves a specific refund by payment and refund IDs.
     *
     * @param int $payment_id Payment ID that owns the refund.
     * @param int $refund_id Refund ID to retrieve.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PaymentRefund The found refund resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com.br/developers/en/reference/chargebacks/_payments_id_refunds_refund_id/get
     */
    public function get(int $payment_id, int $refund_id, ?RequestOptions $request_options = null): PaymentRefund
    {
        $response = parent::send(sprintf(self::URL_WITH_REFUND_ID, strval($payment_id), strval($refund_id)), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentRefund::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Lists all refunds for a given payment.
     *
     * @param int $payment_id Payment ID to list refunds for.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PaymentRefundResult Collection of refund resources.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     * @see https://www.mercadopago.com.br/developers/en/reference/chargebacks/_payments_id_refunds/get
     */
    public function list(int $payment_id, ?RequestOptions $request_options = null): PaymentRefundResult
    {
        $response = parent::send(sprintf(self::URL_WITH_PAYMENT_ID, strval($payment_id)), HttpMethod::GET, null, null, $request_options);
        $result_data = array("data" => $response->getContent());
        $result = Serializer::deserializeFromJson(PaymentRefundResult::class, $result_data);
        $result->setResponse($response);
        return $result;
    }
}
