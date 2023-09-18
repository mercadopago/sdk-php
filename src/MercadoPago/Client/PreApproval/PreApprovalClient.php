<?php

namespace MercadoPago\Client\PreApproval;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\PreApproval;
use MercadoPago\Resources\PreApprovalSearch;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing pre approval actions. */
final class PreApprovalClient extends MercadoPagoClient
{
    private static $URL = "/preapproval";

    private static $URL_WITH_ID = "/preapproval/%s";

    private static $URL_SEARCH = "/preapproval/search";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating a pre approval.
     * @param array $request pre approval data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\PreApproval pre approval created.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(array $request, ?MPRequestOptions $request_options = null): PreApproval
    {
        $response = parent::send(self::$URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PreApproval::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting pre approval.
     * @param string $id pre approval id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\PreApproval pre approval found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function get(string $id, ?MPRequestOptions $request_options = null): PreApproval
    {
        $response = parent::send(sprintf(self::$URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PreApproval::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
    /**
     * Method responsible for update pre approval.
     * @param string $id pre approval id.
     * @param array $request pre approval data.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\PreApproval pre approval canceled.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function update(string $id, array $request, ?MPRequestOptions $request_options = null): PreApproval
    {
        $response = parent::send(sprintf(self::$URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PreApproval::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**     *  Method responsible for search pre approvals.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\PreApprovalSearch search results.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function search(MPSearchRequest $request, ?MPRequestOptions $request_options = null): PreApprovalSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::$URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(PreApprovalSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}