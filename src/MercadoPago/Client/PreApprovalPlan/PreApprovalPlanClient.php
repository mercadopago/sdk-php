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

/**
 * Client for the Subscription Plans API (`/preapproval_plan`).
 *
 * Manages reusable subscription plan templates that define billing frequency,
 * amount, and trial periods. Subscribers are linked to plans via the PreApproval API.
 */
final class PreApprovalPlanClient extends MercadoPagoClient
{
    private const URL = "/preapproval_plan";

    private const URL_WITH_ID = "/preapproval_plan/%s";

    private const URL_SEARCH = "/preapproval_plan/search";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Creates a new subscription plan.
     *
     * @param array<string,mixed> $request Plan data (reason, auto_recurring, back_url, etc.).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PreApprovalPlan The created plan resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function create(array $request, ?RequestOptions $request_options = null): PreApprovalPlan
    {
        $response = parent::send(self::URL, HttpMethod::POST, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PreApprovalPlan::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Retrieves a subscription plan by its ID.
     *
     * @param string $id Plan ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PreApprovalPlan The found plan resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function get(string $id, ?RequestOptions $request_options = null): PreApprovalPlan
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(PreApprovalPlan::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Updates an existing subscription plan.
     *
     * @param string $id Plan ID.
     * @param array<string,mixed> $request Fields to update.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PreApprovalPlan The updated plan resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function update(string $id, array $request, ?RequestOptions $request_options = null): PreApprovalPlan
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::PUT, json_encode($request), null, $request_options);
        $result = Serializer::deserializeFromJson(PreApprovalPlan::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Searches subscription plans with pagination and filters.
     *
     * @param MPSearchRequest $request Search criteria (limit, offset, filters).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return PreApprovalPlanSearch Paginated search results.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
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
