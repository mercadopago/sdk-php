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

/** Client responsible for performing payment refunds actions. */
final class PaymentRefundClient extends MercadoPagoClient
{
    private const URL_WITH_PAYMENT_ID = "/v1/payments/%s/refunds";

    private const URL_WITH_REFUND_ID = "/v1/payments/%s/refunds/%s";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for refunding a payment.
     * @param int $payment_id payment ID.
     * @param float $amount refund amount.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentRefund payment refunded.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
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
     * Method responsible for refunding a payment.
     * @param int $payment_id payment ID.
     * @param float $amount refund amount.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentRefund payment refunded.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
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
     * Method responsible for getting payment.
     * @param int $payment_id payment ID.
     * @param int $refund_id refund ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentRefund refund found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     * @see https://www.mercadopago.com.br/developers/en/reference/chargebacks/_payments_id_refunds_refund_id/get
     */

    public function get(int $payment_id, int $refund_id, ?RequestOptions $request_options = null): PaymentRefund
    {
        $response = parent::send(sprintf(self::URL_WITH_REFUND_ID, strval($payment_id), strval($refund_id)), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PaymentRefund::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /** Method responsible for getting payment.
     * @param int $payment_id payment ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentRefundResult refund found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
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
