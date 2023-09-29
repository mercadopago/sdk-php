<?php

namespace MercadoPago\Tests\Client\Unit\PreApproval;

use MercadoPago\Client\PreApproval\PreApprovalClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * PreApproval Client unit tests.
 */
final class PreApprovalClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/PreApproval/preapproval_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalClient();
        $preapproval = $client->create($this->createRequest());

        $this->assertSame(201, $preapproval->getResponse()->getStatusCode());
        $this->assertSame("2c9380847e9b451c017ea1bd70ba0219", $preapproval->id);
        $this->assertSame(766790067, $preapproval->payer_id);
        $this->assertSame("https://www.mercadopago.com.br", $preapproval->back_url);
        $this->assertSame(823549964, $preapproval->collector_id);
        $this->assertSame(6245132082630004, $preapproval->application_id);
        $this->assertSame("pending", $preapproval->status);
        $this->assertSame("reason", $preapproval->reason);
        $this->assertSame("23546246234", $preapproval->external_reference);
        $this->assertSame("2022-01-10T10:10:10.000-00:00", $preapproval->next_payment_date);
        $this->assertSame("2022-01-10T10:10:10.000-00:00", $preapproval->date_created);
        $this->assertSame("2022-01-10T10:10:10.000-00:00", $preapproval->last_modified);
        $this->assertSame("https://www.mercadopago.com.br/subscriptions/checkout?preapproval_id=2c9380847e9b451c017ea1bd70ba0219", $preapproval->init_point);
        $this->assertSame("2c9380848a630a69018a66713a68020c", $preapproval->preapproval_plan_id);
        $this->assertSame(1, $preapproval->auto_recurring->frequency);
        $this->assertSame("months", $preapproval->auto_recurring->frequency_type);
        $this->assertSame(10.0, $preapproval->auto_recurring->transaction_amount);
        $this->assertSame("BRL", $preapproval->auto_recurring->currency_id);
        $this->assertSame("2022-01-10T10:10:10.000-00:00", $preapproval->auto_recurring->start_date);
        $this->assertSame("2023-01-10T10:10:10.000-00:00", $preapproval->auto_recurring->end_date);
        $this->assertFalse($preapproval->auto_recurring->billing_day_proportional);
        $this->assertFalse($preapproval->auto_recurring->has_billing_day);
        $this->assertSame(11, $preapproval->summarized->quotas);
        $this->assertSame(11, $preapproval->summarized->pending_charge_quantity);
        $this->assertSame(1357.95, $preapproval->summarized->pending_charge_amount);
        $this->assertSame("9008789976", $preapproval->card_id);

    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/PreApproval/preapproval_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalClient();
        $preapproval_id = "2c9380847e9b451c017ea1bd70ba0219";
        $preapproval = $client->get($preapproval_id);

        $this->assertSame(200, $preapproval->getResponse()->getStatusCode());
        $this->assertSame("2c9380847e9b451c017ea1bd70ba0219", $preapproval->id);
        $this->assertSame(766790067, $preapproval->payer_id);
        $this->assertSame("https://www.mercadopago.com.br", $preapproval->back_url);
        $this->assertSame(823549964, $preapproval->collector_id);
        $this->assertSame(6245132082630004, $preapproval->application_id);
        $this->assertSame("pending", $preapproval->status);
        $this->assertSame("reason", $preapproval->reason);
        $this->assertSame("23546246234", $preapproval->external_reference);
        $this->assertSame("2022-01-10T10:10:10.000-00:00", $preapproval->next_payment_date);
        $this->assertSame("2022-01-10T10:10:10.000-00:00", $preapproval->date_created);
        $this->assertSame("2022-01-10T10:10:10.000-00:00", $preapproval->last_modified);
        $this->assertSame("https://www.mercadopago.com.br/subscriptions/checkout?preapproval_id=2c9380847e9b451c017ea1bd70ba0219", $preapproval->init_point);
        $this->assertSame(1, $preapproval->auto_recurring->frequency);
        $this->assertSame("months", $preapproval->auto_recurring->frequency_type);
        $this->assertSame(10.0, $preapproval->auto_recurring->transaction_amount);
        $this->assertSame("BRL", $preapproval->auto_recurring->currency_id);
        $this->assertSame("2022-01-10T10:10:10.000-00:00", $preapproval->auto_recurring->start_date);
        $this->assertSame("2023-01-10T10:10:10.000-00:00", $preapproval->auto_recurring->end_date);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/PreApproval/preapproval_update.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalClient();
        $preapproval_id = "2c9380847e9b451c017ea1bd70ba0219";
        $preapproval = $client->update($preapproval_id, $this->updateRequest());

        $this->assertSame(200, $preapproval->getResponse()->getStatusCode());
        $this->assertSame("2c9380847e9b451c017ea1bd70ba0219", $preapproval->id);
        $this->assertSame("Updated reason", $preapproval->reason);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/PreApproval/preapproval_list.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalClient();
        $search_request = new \MercadoPago\Net\MPSearchRequest(2, 0, ["payer_email" => "test_user_28355466@testuser.com"]);
        $search_result = $client->search($search_request);

        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(2, $search_result->paging->limit);
        $this->assertSame(0, $search_result->paging->offset);
        $this->assertSame(7, $search_result->paging->total);
        $this->assertSame(2, count($search_result->results));
        $this->assertSame("2c9380847e9b1dd5017ea15e30fa01ee", $search_result->results[0]->id);
        $this->assertSame("2c9380847e9b1dd5017ea15f234701f0", $search_result->results[1]->id);
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
