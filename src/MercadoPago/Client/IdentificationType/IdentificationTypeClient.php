<?php

namespace MercadoPago\Client\IdentificationType;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Resources\IdentificationTypeResult;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Identification Types API (`/v1/identification_types`).
 *
 * Lists the available identification document types (e.g., CPF, CNPJ, DNI)
 * for the country associated with the access token. Used to validate
 * payer identification during payment creation.
 */
final class IdentificationTypeClient extends MercadoPagoClient
{
    private const URL = "/v1/identification_types";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Lists all available identification types for the current country.
     *
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return IdentificationTypeResult Collection of identification type resources.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
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
