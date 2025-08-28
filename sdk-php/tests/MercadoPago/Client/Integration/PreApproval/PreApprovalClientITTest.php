<?php

namespace MercadoPago\Tests\Client\Integration\PreApproval;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\PreApproval\PreApprovalClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;
use PHPUnit\Framework\TestCase;

/**
 * PreApprovalClient integration tests.
 */
final class PreApprovalClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        $client = new PreApprovalClient();
        $preapproval = $client->create($this->createRequest());
        $this->assertNotNull($preapproval->id);
    }

    public function testCreateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PreApprovalClient();
        $request = $this->createRequest();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->create($request, $request_options);
    }

    public function testGetSuccess(): void
    {
        $client = new PreApprovalClient();
        $created_preapproval = $client->create($this->createRequest());
        $preapproval = $client->get($created_preapproval->id);
        $this->assertNotNull($preapproval->id);
        $this->assertNotNull($preapproval->back_url);
    }

    public function testGetWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PreApprovalClient();
        $preapproval_id = "2c9380847e9b451c017ea1bd70ba0219";
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->get($preapproval_id, $request_options);
    }

    public function testUpdateSuccess(): void
    {
        $client = new PreApprovalClient();
        $created_preapproval = $client->create($this->createRequest());
        $preapproval = $client->update($created_preapproval->id, $this->updateRequest());
        $this->assertSame("Yoga classes.", $preapproval->reason);
    }

    public function testUpdateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PreApprovalClient();
        $preapproval_id = "2c9380847e9b451c017ea1bd70ba0219";
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->update($preapproval_id, $this->updateRequest(), $request_options);
    }

    public function testSearchSuccess(): void
    {
        $client = new PreApprovalClient();

        $request = $this->createRequest();
        $client->create($request);

        sleep(3);
        $search_request = new MPSearchRequest(1, 0, ["payer_email" => "test_user_28355466@testuser.com"]);
        $search_result = $client->search($search_request);
        $this->assertSame(1, $search_result->paging->limit);
        $this->assertSame(1, count($search_result->results));
        $this->assertNotNull($search_result->results[0]->id);
    }

    public function testSearchWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PreApprovalClient();
        $preapproval_id = "2c9380847e9b451c017ea1bd70ba0219";
        $search_request = new MPSearchRequest(1, 0, ["id" => $preapproval_id]);
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->search($search_request, $request_options);
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
            "reason" => "Yoga classes.",
        ];
        return $request;
    }
}
