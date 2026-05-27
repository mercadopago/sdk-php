<?php

namespace MercadoPago\Client\DisbursementRefund;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\DisbursementRefund;
use MercadoPago\Resources\DisbursementRefundList;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Disbursement Refunds API.
 *
 * Enables full and partial refunds of individual disbursements within an
 * advanced (split) payment.
 *
 * Endpoints:
 *  - `GET  /v1/advanced_payments/{id}/refunds`
 *  - `POST /v1/advanced_payments/{id}/refunds`
 *  - `POST /v1/advanced_payments/{id}/disbursements/{disbursement_id}/refunds`
 */
final class DisbursementRefundClient extends MercadoPagoClient
{
    private const URL_REFUNDS = "/v1/advanced_payments/%s/refunds";

    private const URL_DISBURSEMENT_REFUNDS = "/v1/advanced_payments/%s/disbursements/%s/refunds";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Lists all refunds for an advanced payment.
     *
     * @param int $advanced_payment_id The ID of the advanced payment.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return DisbursementRefundList The list of disbursement refunds.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function listAll(int $advanced_payment_id, ?RequestOptions $request_options = null): DisbursementRefundList
    {
        $response = parent::send(sprintf(self::URL_REFUNDS, $advanced_payment_id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(DisbursementRefundList::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Refunds all disbursements of an advanced payment at once.
     *
     * @param int $advanced_payment_id The ID of the advanced payment.
     * @param array<string,mixed> $request Refund data applied to every disbursement.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return DisbursementRefund The created bulk refund resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function createAll(int $advanced_payment_id, array $request, ?RequestOptions $request_options = null): DisbursementRefund
    {
        $response = parent::send(sprintf(self::URL_REFUNDS, $advanced_payment_id), HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(DisbursementRefund::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Refunds a specific disbursement by amount.
     *
     * @param int $advanced_payment_id The ID of the parent advanced payment.
     * @param int $disbursement_id The ID of the disbursement to refund.
     * @param float $amount The amount to refund.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return DisbursementRefund The created disbursement refund.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function create(int $advanced_payment_id, int $disbursement_id, float $amount, ?RequestOptions $request_options = null): DisbursementRefund
    {
        $payload = ["amount" => $amount];
        $response = parent::send(
            sprintf(self::URL_DISBURSEMENT_REFUNDS, $advanced_payment_id, $disbursement_id),
            HttpMethod::POST,
            json_encode($payload),
            null,
            $request_options
        );
        $result = Serializer::deserializeFromJson(DisbursementRefund::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
