<?php

namespace MercadoPago\Client\Invoice;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Client\Base\BaseClient;

/**
 * InvoiceClient unit tests.
 */
final class InvoiceClientUnitTest extends BaseClient
{
    public function testGetSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Invoice/invoice_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new InvoiceClient();
        $invoice_id = 6114264375;
        $invoice = $client->get($invoice_id);

        $this->assertEquals(200, $invoice->getResponse()->getStatusCode());
        $this->assertEquals(6114264375, $invoice->id);
        $this->assertEquals("scheduled", $invoice->type);
        $this->assertEquals("2022-01-01T11:12:25.892-04:00", $invoice->date_created);
        $this->assertEquals("2022-01-01T11:12:25.892-04:00", $invoice->last_modified);
        $this->assertEquals("2c938084726fca480172750000000000", $invoice->preapproval_id);
        $this->assertEquals("Yoga classes", $invoice->reason);
        $this->assertEquals(23546246234, $invoice->external_reference);
        $this->assertEquals("ARS", $invoice->currency_id);
        $this->assertEquals(10, $invoice->transaction_amount);
        $this->assertEquals("2022-01-01T11:12:25.892-04:00", $invoice->debit_date);
        $this->assertEquals(4, $invoice->retry_attempt);
        $this->assertEquals("scheduled", $invoice->status);
        $this->assertEquals("pending", $invoice->summarized);
        $this->assertEquals(19951521071, $invoice->payment->id);
        $this->assertEquals("approved", $invoice->payment->status);
        $this->assertEquals("status_detail", $invoice->payment->status_detail);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Invoice/invoice_list.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new InvoiceClient();
        $search_request = new \MercadoPago\Net\MPSearchRequest(20, 0, ["external_reference" => 23546246234]);
        $search_result = $client->search($search_request);

        $this->assertEquals(200, $search_result->getResponse()->getStatusCode());
        $this->assertEquals(20, $search_result->paging["limit"]);
        $this->assertEquals(0, $search_result->paging["offset"]);
        $this->assertEquals(1, $search_result->paging["total"]);
        $this->assertEquals(1, count($search_result->results));
        $this->assertEquals(6114264375, $search_result->results[0]["id"]);
    }
}
