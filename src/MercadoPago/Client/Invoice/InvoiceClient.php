<?php

namespace MercadoPago\Client\Invoice;

use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\Invoice;
use MercadoPago\Resources\InvoiceSearch;
use MercadoPago\Serialization\Serializer;

/** Client responsible for performing invoice actions. */
final class InvoiceClient extends MercadoPagoClient
{
    private const URL_WITH_ID = "/authorized_payments/%s";

    private const URL_SEARCH = "/authorized_payments/search";

    /** Default constructor. Uses the default http client used by the SDK. */
    public function __construct()
    {
        parent::__construct(MercadoPagoConfig::getHttpClient());
    }

    /**
     * Method responsible for getting an invoice.
     * @param int $id invoice id.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\Invoice invoice found.
     */
    public function get(int $id, ?MPRequestOptions $request_options = null): Invoice
    {
        try {
            $response = parent::send(sprintf(self::URL_WITH_ID, $id), HttpMethod::GET, null, null, $request_options);
            $result = Serializer::deserializeFromJson(Invoice::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }

    /**
     *  Method responsible for search invoices.
     * @param \MercadoPago\Net\MPSearchRequest $request search request.
     * @param mixed $request_options request options to be sent.
     * @return \MercadoPago\Resources\InvoiceSearch search results.
     */
    public function search(MPSearchRequest $request, ?MPRequestOptions $request_options = null): InvoiceSearch
    {
        try {
            $query_params = isset($request) ? $request->getParameters() : null;
            $response = parent::send(self::URL_SEARCH, HttpMethod::GET, null, $query_params, $request_options);
            $result = Serializer::deserializeFromJson(InvoiceSearch::class, $response->getContent());
            $result->setResponse($response);
            return $result;
        } catch (MPApiException | \Exception $e) {
            throw $e;
        }
    }
}
