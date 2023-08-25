<?php

namespace MercadoPago\Client\PaymentMethod;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Resources\PaymentMethodResult;

/** Client responsible for performing payment methods actions. */
class PaymentMethodClient extends MercadoPagoClient
{
    private static $URL = "/v1/payment_methods";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for getting array from payment methods.
     * @param \MercadoPago\Core\MPRequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PaymentMethodResult result from payment method found.
     */
    public function get(?MPRequestOptions $request_options = null): PaymentMethodResult
    {
        try {
            $response = parent::send(self::$URL, HttpMethod::GET, null, null, $request_options);

            $result = new PaymentMethodResult();
            $result-> data = $response -> getContent();
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }
}
