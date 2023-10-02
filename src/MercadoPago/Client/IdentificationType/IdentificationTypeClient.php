<?php

namespace MercadoPago\Client\IdentificationType;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\IdentificationTypeResult;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing identification type actions. */
final class IdentificationTypeClient extends MercadoPagoClient
{
    private const URL = "/v1/identification_types";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for list identification types.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\IdentificationTypeResult identification type found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function list(?RequestOptions $request_options = null): IdentificationTypeResult
    {
        $response = parent::send(self::URL, HttpMethod::GET, null, null, $request_options);
        $result_data = array("data" => $response->getContent());
        $result = Serializer::deserializeFromJson(IdentificationTypeResult::class, $result_data);
        $result->setResponse($response);
        return $result;
    }
}
