<?php

namespace MercadoPago\Client\Invoice;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\Invoice;
use MercadoPago\Resources\InvoiceSearch;
use MercadoPago\Serialization\Serializer;

/**
 * Client for the Authorized Payments (Invoice) API (`/authorized_payments`).
 *
 * Manages invoices generated from subscription (pre-approval) charges.
 * Each invoice represents a scheduled payment within an active subscription.
 */
final class InvoiceClient extends MercadoPagoClient
{
    private const URL_WITH_ID = "/authorized_payments/%s";

    private const URL_SEARCH = "/authorized_payments/search";

    /** @param MPHttpClient|null $MPHttpClient Custom HTTP client. Defaults to the SDK global client. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Retrieves an invoice (authorized payment) by its ID.
     *
     * @param int $id Invoice ID.
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return Invoice The found invoice resource.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function get(int $id, ?RequestOptions $request_options = null): Invoice
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Invoice::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Searches invoices with pagination and filters.
     *
     * @param MPSearchRequest $request Search criteria (limit, offset, filters like status, preapproval_id).
     * @param RequestOptions|null $request_options Per-request configuration overrides.
     * @return InvoiceSearch Paginated search results containing matching invoices.
     * @throws \MercadoPago\Exceptions\MPApiException When the API returns a non-2xx status code.
     * @throws \Exception On transport-level errors.
     */
    public function search(MPSearchRequest $request, ?RequestOptions $request_options = null): InvoiceSearch
    {
        $query_params = isset($request) ? $request->getParameters() : null;
        $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
        $result = Serializer::deserializeFromJson(InvoiceSearch::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }
}
