<?php

namespace MercadoPago\Client\PreApprovalPlan;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\PreApprovalPlan;
use MercadoPago\Resources\PreApprovalPlanSearch;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing subscription plan. */
final class PreApprovalPlanClient extends MercadoPagoClient
{
    private const URL = "/preapproval_plan";

    private const URL_WITH_ID = "/preapproval_plan/%s";

    private const URL_SEARCH = "/preapproval_plan/search";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for creating a subscription plan.
     * @param array $request subscription plan data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PreApprovalPlan subscription plan created.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function create(array $request, ?RequestOptions $request_options = null): PreApprovalPlan
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PreApprovalPlan::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for getting pre approval plan.
     * @param string $id pre approval plan ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PreApprovalPlan pre approval plan found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function get(string $id, ?RequestOptions $request_options = null): PreApprovalPlan
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PreApprovalPlan::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for update pre approval plan.
     * @param string $id pre approval plan ID.
     * @param array $request pre approval plan data.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PreApprovalPlan pre approval plan canceled.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function update(string $id, array $request, ?RequestOptions $request_options = null): PreApprovalPlan
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PreApprovalPlan::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     *  Method responsible for search pre approval plan.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\PreApprovalPlanSearch search results.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function search(MPSearchRequest $request, ?RequestOptions $request_options = null): PreApprovalPlanSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(PreApprovalPlanSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
