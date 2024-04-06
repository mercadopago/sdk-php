<?php

namespace MercadoPago\Tests\Client\Unit\Invoice;

use MercadoPago\Client\Invoice\InvoiceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * InvoiceClient unit tests.
 */
final class InvoiceClientUnitTest extends BaseClient
{
    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Invoice/invoice_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new InvoiceClient();
        $invoice_id = 6114264375;
        $invoice = $client->get($invoice_id);

        $this->assertSame(200, $invoice->getResponse()->getStatusCode());
        $this->assertSame(6114264375, $invoice->id);
        $this->assertSame("scheduled", $invoice->type);
        $this->assertSame("2022-01-01T11:12:25.892-04:00", $invoice->date_created);
        $this->assertSame("2022-01-01T11:12:25.892-04:00", $invoice->last_modified);
        $this->assertSame("2c938084726fca480172750000000000", $invoice->preapproval_id);
        $this->assertSame("Yoga classes", $invoice->reason);
        $this->assertSame("YG-23546246234", $invoice->external_reference);
        $this->assertSame("ARS", $invoice->currency_id);
        $this->assertSame(10.0, $invoice->transaction_amount);
        $this->assertSame("2022-01-01T11:12:25.892-04:00", $invoice->debit_date);
        $this->assertSame(4, $invoice->retry_attempt);
        $this->assertSame("scheduled", $invoice->status);
        $this->assertSame("pending", $invoice->summarized);
        $this->assertSame(19951521071, $invoice->payment->id);
        $this->assertSame("approved", $invoice->payment->status);
        $this->assertSame("status_detail", $invoice->payment->status_detail);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Invoice/invoice_list.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new InvoiceClient();
        $search_request = new \MercadoPago\Net\MPSearchRequest(20, 0, ["external_reference" => 23546246234]);
        $search_result = $client->search($search_request);

        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(20, $search_result->paging->limit);
        $this->assertSame(0, $search_result->paging->offset);
        $this->assertSame(1, $search_result->paging->total);
        $this->assertSame(1, count($search_result->results));
        $this->assertSame(6114264375, $search_result->results[0]->id);
    }
}
