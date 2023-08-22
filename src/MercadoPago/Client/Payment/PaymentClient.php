<?php

namespace MercadoPago\Client\Payment;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\Payment;
use MercadoPago\Resources\PaymentSearch;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing payment actions. */
class PaymentClient extends MercadoPagoClient
{
    private static $URL = "/v1/payments";

    private static $URL_WITH_ID = "/v1/payments/%s";

    private static $URL_SEARCH = "/v1/payments/search";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating payment.
     * @param array $request payment data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Payment payment created.
     */
    public function create(array $request, ?MPRequestOptions $request_options = null): Payment
    {
        try {
            $response = parent::send(self::$URL, HttpMethod::POST, json_encode($request), null, $request_options);
            $result = Serializer::deserializeFromJson(Payment::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for getting payment.
     * @param int $id payment id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Payment payment found.
     */
    public function get(int $id, ?MPRequestOptions $request_options = null): Payment
    {
        try {
            $response = parent::send(sprintf(self::$URL_WITH_ID, strval($id)), HttpMethod::GET, null, null, $request_options);
            $result = Serializer::deserializeFromJson(Payment::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for cancel payment.
     * @param int $id payment id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Payment payment canceled.
     */
    public function cancel(int $id, ?MPRequestOptions $request_options = null): Payment
    {
        try {
            $payload = new PaymentCancelRequest();
            $response = parent::send(sprintf(self::$URL_WITH_ID, strval($id)), HttpMethod::PUT, json_encode($payload), null, $request_options);
            $result = Serializer::deserializeFromJson(Payment::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     * Method responsible for capture payment.
     * @param int $id payment id.
     * @param mixed $amount amount to be captured.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Payment payment captured.
     */
    public function capture(int $id, ?float $amount, ?MPRequestOptions $request_options = null): Payment
    {
        try {
            $payload = new PaymentCaptureRequest();
            $payload->transaction_amount = $amount;
            $response = parent::send(sprintf(self::$URL_WITH_ID, strval($id)), HttpMethod::PUT, json_encode($payload), null, $request_options);
            $result = Serializer::deserializeFromJson(Payment::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     *  Method responsible for search payments.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\PaymentSearch search results.
     */
    public function search(MPSearchRequest $request, ?MPRequestOptions $request_options = null): PaymentSearch
    {
        try {
            $query_params = isset($request) ? $request->getParameters() : null;
            $response = parent::send(self::$URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
            $result = Serializer::deserializeFromJson(PaymentSearch::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }
}
