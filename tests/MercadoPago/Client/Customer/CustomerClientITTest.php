<?php

namespace MercadoPago\Tests\Client\Customer;

use MercadoPago\Client\Customer\CustomerClient;
use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;
use PHPUnit\Framework\TestCase;

/**
 * Customer Client integration tests.
 */
final class CustomerClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        $client = new CustomerClient();
        $id = rand(100000, 200000);
        $email = sprintf("test_user_sdk_%s@testuser.com", $id);
        $customer = $client->create($this->createRequest($email));
        $this->assertNotNull($customer->id);
    }

    public function testCreateByEmailSuccess(): void
    {
        $client = new CustomerClient();
        $id = rand(100000, 200000);
        $email = sprintf("test_user_sdk_%s@testuser.com", $id);
        $customer = $client->createByEmail($email);
        $this->assertNotNull($customer->id);
    }

    public function testCreateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CustomerClient();
        $id = rand(100000, 200000);
        $email = sprintf("test_user_sdk_%s@testuser.com", $id);
        $request = $this->createRequest($email);
        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->create($request, $request_options);
    }

    public function testGetSuccess(): void
    {
        $client = new CustomerClient();
        $id = rand(100000, 200000);
        $email = sprintf("test_user_sdk_%s@testuser.com", $id);
        $created_customer = $client->create($this->createRequest($email));

        $get_customer = $client->get($created_customer->id);
        $this->assertNotNull($get_customer->id);
    }

    public function testGetWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CustomerClient();
        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->get("1469979538-52qKdADBYeloaX", $request_options);
    }

    public function testUpdateSuccess(): void
    {
        $client = new CustomerClient();
        $id = rand(100000, 200000);
        $email = sprintf("test_user_sdk_%s@testuser.com", $id);
        $customer = $client->create($this->createRequest($email));
        $this->assertNotNull($customer->id);

        $description_customer = "Test update";
        $update_customer = $client->update($customer->id, $this->updateRequest($description_customer));
        $this->assertEquals("Test update", $update_customer->description);
    }

    public function testUpdateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CustomerClient();
        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->update("1469979538-52qKdADBYeloaX", $this->updateRequest(""), $request_options);
    }


    public function testSearchSuccess(): void
    {
        $client = new CustomerClient();
        $id = rand(100000, 200000);
        $email = sprintf("test_user_sdk_%s@testuser.com", $id);
        $created_customer = $client->create($this->createRequest($email));
        $search_request = new MPSearchRequest(1, 0, ["email" => $email]);

        sleep(3);
        $search_result = $client->search($search_request);
        $this->assertNotNull($search_result->paging);
        $this->assertNotNull($search_result->results);
        $this->assertEquals(1, count($search_result->results));
        $this->assertEquals($created_customer->id, $search_result->results[0]["id"]);
    }

    public function testSearchWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CustomerClient();
        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->search(null, $request_options);
    }

    private function createRequest(string $email): array
    {
        $request = [
            "email" => $email
        ];
        return $request;
    }

    private function updateRequest(string $description_customer): array
    {
        $request = [
            "description" => $description_customer
        ];
        return $request;
    }
}