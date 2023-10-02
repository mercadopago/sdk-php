<?php

namespace MercadoPago\Client\PreApproval;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\PreApproval;
use MercadoPago\Resources\PreApprovalSearch;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing pre approval actions. */
final class PreApprovalClient extends MercadoPagoClient
{
    private const URL = "/preapproval";

    private const URL_WITH_ID = "/preapproval/%s";

    private const URL_SEARCH = "/preapproval/search";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating a pre approval.
     * @param array $request pre approval data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PreApproval pre approval created.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(array $request, ?RequestOptions $request_options = null): PreApproval
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PreApproval::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting pre approval.
     * @param string $id pre approval ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PreApproval pre approval found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function get(string $id, ?RequestOptions $request_options = null): PreApproval
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PreApproval::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
    /**
     * Method responsible for update pre approval.
     * @param string $id pre approval ID.
     * @param array $request pre approval data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PreApproval pre approval canceled.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function update(string $id, array $request, ?RequestOptions $request_options = null): PreApproval
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PreApproval::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**     *  Method responsible for search pre approvals.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PreApprovalSearch search results.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function search(MPSearchRequest $request, ?RequestOptions $request_options = null): PreApprovalSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(PreApprovalSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
