<?php

namespace MercadoPago\Client\Customer;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Client\Base\BaseClient;

/**
 * Customer Client unit tests.
 */
final class CustomerClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Customer/customer_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new CustomerClient();
        $customer = $client->create($this->createRequest());
        $this->assertEquals(201, $customer->getResponse()->getStatusCode());
        $this->assertEquals("1469979538-52qKdADBYeloaX", $customer->id);
        $this->assertEquals("test_cust_1693832456@testuser.com", $customer->email);
        $this->assertEquals("Test", $customer->first_name);
        $this->assertEquals("Customer", $customer->last_name);
        $this->assertEquals("Customer description", $customer->description);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customer->date_created);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customer->date_last_updated);
        $this->assertEquals("1322811505", $customer->default_address);
        $this->assertEquals(1469979538, $customer->user_id);
        $this->assertEquals(471763966, $customer->merchant_id);
        $this->assertEquals(558881221729581, $customer->client_id);
        $this->assertEquals("active", $customer->status);

        $this->assertEquals("11", $customer->phone->area_code);
        $this->assertEquals("999990101", $customer->phone->number);

        $this->assertEquals("CPF", $customer->identification->type);
        $this->assertEquals("19119119100", $customer->identification->number);

        $this->assertEquals("1322811505", $customer->address->id);
        $this->assertEquals("02675031", $customer->address->zip_code);
        $this->assertEquals("Av. das Nações Unidas", $customer->address->street_name);
        $this->assertEquals(3000, $customer->address->street_number);
    }

    public function testCreateByEmailSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Customer/customer_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new CustomerClient();
        $email = "test_cust_1693832456@testuser.com";
        $customer = $client->createByEmail($email);
        $this->assertEquals(201, $customer->getResponse()->getStatusCode());
        $this->assertEquals("1469979538-52qKdADBYeloaX", $customer->id);
        $this->assertEquals("test_cust_1693832456@testuser.com", $customer->email);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customer->date_created);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customer->date_last_updated);
        $this->assertEquals("1322811505", $customer->default_address);
        $this->assertEquals(1469979538, $customer->user_id);
        $this->assertEquals(471763966, $customer->merchant_id);
        $this->assertEquals(558881221729581, $customer->client_id);
        $this->assertEquals("active", $customer->status);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Customer/customer_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new CustomerClient();
        $customer_id = "1469979538-52qKdADBYeloaX";
        $customer = $client->get($customer_id);
        $this->assertEquals(200, $customer->getResponse()->getStatusCode());
        $this->assertEquals("1469979538-52qKdADBYeloaX", $customer->id);
        $this->assertEquals("test_cust_1693832456@testuser.com", $customer->email);
        $this->assertEquals("Test", $customer->first_name);
        $this->assertEquals("Customer", $customer->last_name);
        $this->assertEquals("Customer description", $customer->description);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customer->date_created);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customer->date_last_updated);
        $this->assertEquals("1322811505", $customer->default_address);
        $this->assertEquals(1469979538, $customer->user_id);
        $this->assertEquals(471763966, $customer->merchant_id);
        $this->assertEquals(558881221729581, $customer->client_id);
        $this->assertEquals("active", $customer->status);

        $this->assertEquals("11", $customer->phone->area_code);
        $this->assertEquals("999990101", $customer->phone->number);

        $this->assertEquals("CPF", $customer->identification->type);
        $this->assertEquals("19119119100", $customer->identification->number);

        $this->assertEquals("1322811505", $customer->address->id);
        $this->assertEquals("02675031", $customer->address->zip_code);
        $this->assertEquals("Av. das Nações Unidas", $customer->address->street_name);
        $this->assertEquals(3000, $customer->address->street_number);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Customer/customer_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new CustomerClient();
        $customer_id = "1469979538-52qKdADBYeloaX";
        $customer = $client->update($customer_id, $this->createRequest());
        $this->assertEquals(200, $customer->getResponse()->getStatusCode());
        $this->assertEquals("1469979538-52qKdADBYeloaX", $customer->id);
        $this->assertEquals("test_cust_1693832456@testuser.com", $customer->email);
        $this->assertEquals("Test", $customer->first_name);
        $this->assertEquals("Customer", $customer->last_name);
        $this->assertEquals("Customer description", $customer->description);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customer->date_created);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customer->date_last_updated);
        $this->assertEquals("1322811505", $customer->default_address);
        $this->assertEquals(1469979538, $customer->user_id);
        $this->assertEquals(471763966, $customer->merchant_id);
        $this->assertEquals(558881221729581, $customer->client_id);
        $this->assertEquals("active", $customer->status);

        $this->assertEquals("11", $customer->phone->area_code);
        $this->assertEquals("999990101", $customer->phone->number);

        $this->assertEquals("CPF", $customer->identification->type);
        $this->assertEquals("19119119100", $customer->identification->number);

        $this->assertEquals("1322811505", $customer->address->id);
        $this->assertEquals("02675031", $customer->address->zip_code);
        $this->assertEquals("Av. das Nações Unidas", $customer->address->street_name);
        $this->assertEquals(3000, $customer->address->street_number);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Customer/customer_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new CustomerClient();
        $customers = $client->search();
        $this->assertEquals(200, $customers->getResponse()->getStatusCode());
        $this->assertEquals(10, $customers->paging["limit"]);
        $this->assertEquals(0, $customers->paging["offset"]);
        $this->assertEquals(2, $customers->paging["total"]);
        $this->assertEquals(2, count($customers->results));

        $this->assertEquals("1469979538-52qKdADBYeloaX", $customers->results[0]["id"]);
        $this->assertEquals("test_cust_1693832456@testuser.com", $customers->results[0]["email"]);
        $this->assertEquals("Test", $customers->results[0]["first_name"]);
        $this->assertEquals("Customer", $customers->results[0]["last_name"]);
        $this->assertEquals("Customer description", $customers->results[0]["description"]);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customers->results[0]["date_created"]);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customers->results[0]["date_last_updated"]);
        $this->assertEquals("1322811505", $customers->results[0]["default_address"]);
        $this->assertEquals(1469979538, $customers->results[0]["user_id"]);
        $this->assertEquals(471763966, $customers->results[0]["merchant_id"]);
        $this->assertEquals(558881221729581, $customers->results[0]["client_id"]);
        $this->assertEquals("active", $customers->results[0]["status"]);

        $this->assertEquals("1439324851-zk2BeFiet6otYD", $customers->results[1]["id"]);
        $this->assertEquals("test_user_1684943300@testuser.com", $customers->results[1]["email"]);
        $this->assertEquals("Test", $customers->results[1]["first_name"]);
        $this->assertEquals("Customer", $customers->results[1]["last_name"]);
        $this->assertEquals("Customer description", $customers->results[1]["description"]);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customers->results[1]["date_created"]);
        $this->assertEquals("2023-09-04T09:00:57.374-04:00", $customers->results[1]["date_last_updated"]);
        $this->assertEquals("1322811505", $customers->results[1]["default_address"]);
        $this->assertEquals(1469979538, $customers->results[1]["user_id"]);
        $this->assertEquals(471763966, $customers->results[1]["merchant_id"]);
        $this->assertEquals(558881221729581, $customers->results[1]["client_id"]);
        $this->assertEquals("active", $customers->results[1]["status"]);
    }

    private function createRequest(): array
    {
        $request = [
          "email" => "test_cust_1693832456@testuser.com",
          "first_name" => "Test",
          "last_name" => "Customer",
          "description" => "Customer description",
          "phone" => [
              "area_code" => "11",
              "number" => "999990101",
          ],
          "identification" => [
            "type" => "CPF",
            "number" => "19119119100",
          ],
          "address" => [
            "id" => "Casa",
            "zip_code" => "02675031",
            "street_name" => "Av. das Nações Unidas",
            "street_number" => 3003,
            "city" => [
              "name" => "Osasco",
            ]
          ]
        ];
        return $request;
    }
}
