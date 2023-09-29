<?php

namespace MercadoPago\Tests\Client\Unit\PreApprovalPlan;

use MercadoPago\Client\PreApprovalPlan\PreApprovalPlanClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * PreApprovalPlan Client unit tests.
 */
final class PreApprovalPlanClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/PreApprovalPlan/preapprovalplan_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalPlanClient();
        $plan = $client->create($this->createRequest());

        $this->assertSame(201, $plan->getResponse()->getStatusCode());
        $this->assertSame("2c9380848a610f84018a6543a3010320", $plan->id);
        $this->assertSame("https://www.yoursite.com", $plan->back_url);
        $this->assertSame(1160535239, $plan->collector_id);
        $this->assertSame(1979447422004048, $plan->application_id);
        $this->assertSame("Yoga classes", $plan->reason);
        $this->assertSame("active", $plan->status);
        $this->assertSame("2023-09-05T08:14:06.082-04:00", $plan->date_created);
        $this->assertSame("2023-09-05T08:14:06.300-04:00", $plan->last_modified);
        $this->assertSame("https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380848a610f84018a6543a3010320", $plan->init_point);
        $this->assertSame(1, $plan->auto_recurring->frequency);
        $this->assertSame("months", $plan->auto_recurring->frequency_type);
        $this->assertSame(10.0, $plan->auto_recurring->transaction_amount);
        $this->assertSame("BRL", $plan->auto_recurring->currency_id);
        $this->assertSame(12, $plan->auto_recurring->repetitions);
        $this->assertSame(1, $plan->auto_recurring->free_trial->frequency);
        $this->assertSame("months", $plan->auto_recurring->free_trial->frequency_type);
        $this->assertSame(30, $plan->auto_recurring->free_trial->first_invoice_offset);
        $this->assertSame(10, $plan->auto_recurring->billing_day);
        $this->assertTrue($plan->auto_recurring->billing_day_proportional);
        $this->assertSame(1.67, $plan->auto_recurring->transaction_amount_proportional);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/PreApprovalPlan/preapprovalplan_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalPlanClient();
        $plan_id = "2c9380848a610f84018a6543a3010320";
        $plan = $client->get($plan_id);

        $this->assertSame(200, $plan->getResponse()->getStatusCode());
        $this->assertSame("2c9380848a610f84018a6543a3010320", $plan->id);
        $this->assertSame("https://www.yoursite.com", $plan->back_url);
        $this->assertSame(1160535239, $plan->collector_id);
        $this->assertSame(1979447422004048, $plan->application_id);
        $this->assertSame("Yoga classes", $plan->reason);
        $this->assertSame("active", $plan->status);
        $this->assertSame("2023-09-05T08:14:06.082-04:00", $plan->date_created);
        $this->assertSame("2023-09-05T08:14:06.300-04:00", $plan->last_modified);
        $this->assertSame("https://www.mercadopago.com.br/subscriptions/checkout?preapproval_plan_id=2c9380848a610f84018a6543a3010320", $plan->init_point);
        $this->assertSame(1, $plan->auto_recurring->frequency);
        $this->assertSame("months", $plan->auto_recurring->frequency_type);
        $this->assertSame(10.0, $plan->auto_recurring->transaction_amount);
        $this->assertSame("BRL", $plan->auto_recurring->currency_id);
        $this->assertSame(12, $plan->auto_recurring->repetitions);
        $this->assertSame(1, $plan->auto_recurring->free_trial->frequency);
        $this->assertSame("months", $plan->auto_recurring->free_trial->frequency_type);
        $this->assertSame(30, $plan->auto_recurring->free_trial->first_invoice_offset);
        $this->assertSame(10, $plan->auto_recurring->billing_day);
        $this->assertTrue($plan->auto_recurring->billing_day_proportional);
        $this->assertSame(1.67, $plan->auto_recurring->transaction_amount_proportional);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/PreApprovalPlan/preapprovalplan_update.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalPlanClient();
        $plan_id = "2c9380848a610f84018a6543a3010320";
        $plan = $client->update($plan_id, $this->updateRequest());

        $this->assertSame(200, $plan->getResponse()->getStatusCode());
        $this->assertSame("2c9380848a610f84018a6543a3010320", $plan->id);
        $this->assertSame("reason", $plan->reason);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/PreApprovalPlan/preapprovalplan_list.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreApprovalPlanClient();
        $search_request = new \MercadoPago\Net\MPSearchRequest(10, 0, ["back_url" => "https://www.yoursite.com"]);
        $search_result = $client->search($search_request);

        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(10, $search_result->paging->limit);
        $this->assertSame(0, $search_result->paging->offset);
        $this->assertSame(1, $search_result->paging->total);
        $this->assertSame(1, count($search_result->results));
        $this->assertSame("2c9380848a610f84018a6543a3010320", $search_result->results[0]->id);

    }

    private function createRequest(): array
    {
        $request = [
            "reason" => "Yoga classes",
            "auto_recurring" => array(
                "frequency" => 1,
                "frequency_type" => "months",
                "repetitions" => 12,
                "billing_day" => 10,
                "billing_day_proportional" => true,
                "free_trial" => array(
                    "frequency" => 1,
                    "frequency_type" => "months"
                ),
                "transaction_amount" => 10,
                "currency_id" => "BRL"
            ),
            "back_url" => "https://www.yoursite.com"
        ];
        return $request;
    }

    private function updateRequest(): array
    {
        $request = [
            "reason" => "Yoga classes.",
        ];
        return $request;
    }
}
