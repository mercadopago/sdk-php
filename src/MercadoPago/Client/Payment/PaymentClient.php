<?php

namespace MercadoPago\Client\Payment;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Resources\Payment\Payment;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing payment actions. */
class PaymentClient extends MercadoPagoClient
{
    private static $URL = "/v1/payments";

    private static $URL_WITH_ID = "/v1/payments/%s";


    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating payment.
     */
    public function create(array $request, ?MPRequestOptions $requestOptions = null): Payment
    {
        $response = parent::send(self::$URL, HttpMethod::POST, json_encode($request), $requestOptions);
        $result = Serializer::deserializeFromJson(Payment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting payment.
     */
    public function get(int $id, ?MPRequestOptions $requestOptions = null): Payment
    {
        $response = parent::send(sprintf(self::$URL_WITH_ID, strval($id)), HttpMethod::GET, $requestOptions);
        $result = Serializer::deserializeFromJson(Payment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for cancel payment.
     */
    public function cancel(int $id, ?MPRequestOptions $requestOptions = null): Payment
    {
        $payload = new PaymentCancelRequest();
        $response = parent::send(sprintf(self::$URL_WITH_ID, strval($id)), HttpMethod::PUT, json_encode($payload), $requestOptions);
        $result = Serializer::deserializeFromJson(Payment::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
