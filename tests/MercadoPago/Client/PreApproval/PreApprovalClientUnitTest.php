<?php

namespace MercadoPago\Client\PreApproval;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Client\Base\BaseClient;

/**
 * PreApproval Client unit tests.
 */
final class PreApprovalClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/PreApproval/preapproval_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalClient();
        $preapproval = $client->create($this->createRequest());

        $this->assertEquals(201, $preapproval->getResponse()->getStatusCode());
        $this->assertEquals("2c9380847e9b451c017ea1bd70ba0219", $preapproval->id);
        $this->assertEquals(766790067, $preapproval->payer_id);
        $this->assertEquals("https://www.mercadopago.com.br", $preapproval->back_url);
        $this->assertEquals(823549964, $preapproval->collector_id);
        $this->assertEquals(6245132082630004, $preapproval->application_id);
        $this->assertEquals("pending", $preapproval->status);
        $this->assertEquals("reason", $preapproval->reason);
        $this->assertEquals("23546246234", $preapproval->external_reference);
        $this->assertEquals("2022-01-10T10:10:10.000-00:00", $preapproval->next_payment_date);
        $this->assertEquals("2022-01-10T10:10:10.000-00:00", $preapproval->date_created);
        $this->assertEquals("2022-01-10T10:10:10.000-00:00", $preapproval->last_modified);
        $this->assertEquals("https://www.mercadopago.com.br/subscriptions/checkout?preapproval_id=2c9380847e9b451c017ea1bd70ba0219", $preapproval->init_point);
        $this->assertEquals("2c9380848a630a69018a66713a68020c", $preapproval->preapproval_plan_id);
        $this->assertEquals(1, $preapproval->auto_recurring->frequency);
        $this->assertEquals("months", $preapproval->auto_recurring->frequency_type);
        $this->assertEquals(10, $preapproval->auto_recurring->transaction_amount);
        $this->assertEquals("BRL", $preapproval->auto_recurring->currency_id);
        $this->assertEquals("2022-01-10T10:10:10.000-00:00", $preapproval->auto_recurring->start_date);
        $this->assertEquals("2023-01-10T10:10:10.000-00:00", $preapproval->auto_recurring->end_date);
        $this->assertFalse($preapproval->auto_recurring->billing_day_proportional);
        $this->assertFalse($preapproval->auto_recurring->has_billing_day);
        $this->assertEquals(11, $preapproval->summarized->quotas);
        $this->assertEquals(11, $preapproval->summarized->pending_charge_quantity);
        $this->assertEquals(1357.95, $preapproval->summarized->pending_charge_amount);
        $this->assertEquals("9008789976", $preapproval->card_id);

    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/PreApproval/preapproval_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalClient();
        $preapproval_id = "2c9380847e9b451c017ea1bd70ba0219";
        $preapproval = $client->get($preapproval_id);

        $this->assertEquals(200, $preapproval->getResponse()->getStatusCode());
        $this->assertEquals("2c9380847e9b451c017ea1bd70ba0219", $preapproval->id);
        $this->assertEquals(766790067, $preapproval->payer_id);
        $this->assertEquals("https://www.mercadopago.com.br", $preapproval->back_url);
        $this->assertEquals(823549964, $preapproval->collector_id);
        $this->assertEquals(6245132082630004, $preapproval->application_id);
        $this->assertEquals("pending", $preapproval->status);
        $this->assertEquals("reason", $preapproval->reason);
        $this->assertEquals("23546246234", $preapproval->external_reference);
        $this->assertEquals("2022-01-10T10:10:10.000-00:00", $preapproval->next_payment_date);
        $this->assertEquals("2022-01-10T10:10:10.000-00:00", $preapproval->date_created);
        $this->assertEquals("2022-01-10T10:10:10.000-00:00", $preapproval->last_modified);
        $this->assertEquals("https://www.mercadopago.com.br/subscriptions/checkout?preapproval_id=2c9380847e9b451c017ea1bd70ba0219", $preapproval->init_point);
        $this->assertEquals(1, $preapproval->auto_recurring->frequency);
        $this->assertEquals("months", $preapproval->auto_recurring->frequency_type);
        $this->assertEquals(10, $preapproval->auto_recurring->transaction_amount);
        $this->assertEquals("BRL", $preapproval->auto_recurring->currency_id);
        $this->assertEquals("2022-01-10T10:10:10.000-00:00", $preapproval->auto_recurring->start_date);
        $this->assertEquals("2023-01-10T10:10:10.000-00:00", $preapproval->auto_recurring->end_date);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/PreApproval/preapproval_update.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalClient();
        $preapproval_id = "2c9380847e9b451c017ea1bd70ba0219";
        $preapproval = $client->update($preapproval_id, $this->updateRequest());

        $this->assertEquals(200, $preapproval->getResponse()->getStatusCode());
        $this->assertEquals("2c9380847e9b451c017ea1bd70ba0219", $preapproval->id);
        $this->assertEquals("Updated reason", $preapproval->reason);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/PreApproval/preapproval_list.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalClient();
        $search_request = new \MercadoPago\Net\MPSearchRequest(2, 0, ["payer_email" => "test_user_28355466@testuser.com"]);
        $search_result = $client->search($search_request);

        $this->assertEquals(200, $search_result->getResponse()->getStatusCode());
        $this->assertEquals(2, $search_result->paging["limit"]);
        $this->assertEquals(0, $search_result->paging["offset"]);
        $this->assertEquals(7, $search_result->paging["total"]);
        $this->assertEquals(2, count($search_result->results));
        $this->assertEquals("2c9380847e9b1dd5017ea15e30fa01ee", $search_result->results[0]["id"]);
        $this->assertEquals("2c9380847e9b1dd5017ea15f234701f0", $search_result->results[1]["id"]);
    }

    private function createRequest(): array
    {
        $request = [
          "back_url" => "https://www.mercadopago.com.br",
          "external_reference" => "23546246234",
          "reason" => "Monthly subscription to premium package",
          "auto_recurring" => array(
            "frequency" => 1,
            "frequency_type" => "months",
            "transaction_amount" => 10,
            "currency_id" => "BRL",
          ),
          "payer_email" => "test_user_28355466@testuser.com",
        ];
        return $request;
    }

    private function updateRequest(): array
    {
        $request = [
          "reason" => "Updated reason",
        ];
        return $request;
    }
}
