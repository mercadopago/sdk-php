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

/** Client responsible for performing invoice actions. */
final class InvoiceClient extends MercadoPagoClient
{
    private const URL_WITH_ID = "/authorized_payments/%s";

    private const URL_SEARCH = "/authorized_payments/search";

    /** Default constructor. Uses the default http client used by the SDK or custom http client provided. */
    public function __construct(?MPHttpClient $MPHttpClient = null)
    {
        parent::__construct($MPHttpClient ?: MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for getting an invoice.
     * @param int $id invoice ID.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\Invoice invoice found.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
     */
    public function get(int $id, ?RequestOptions $request_options = null): Invoice
    {
        $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
        $result = Serializer::deserializeFromJson(Invoice::class, $response->getContent());
        $result->setResponse($response);
        return $result;
    }

    /**
     * Method responsible for search invoices.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param \MercadoPago\Client\Common\RequestOptions request options to be sent.
     * @return \MercadoPago\Resources\InvoiceSearch search results.
     * @throws \MercadoPago\Exceptions\MPApiException if the request fails.
     * @throws \Exception if the request fails.
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
