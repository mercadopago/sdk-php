<?php

namespace MercadoPago\Tests\Client\Unit\Customer;

use MercadoPago\Client\Customer\CustomerCardClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * Customer Card Client unit tests.
 */
final class CustomerCardClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Customer/customer_card_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new CustomerCardClient();
        $customer_id = "98765432-nfd98efh6u";
        $customer_card = $client->create($customer_id, $this->createRequest());
        $this->assertSame(201, $customer_card->getResponse()->getStatusCode());
        $this->assertSame("1562188766852", $customer_card->id);
        $this->assertSame(6, $customer_card->expiration_month);
        $this->assertSame("credit_card", $customer_card->payment_method->payment_type_id);
        $this->assertSame("http://img.mlstatic.com/org-img/MP3/API/logos/visa.gif", $customer_card->payment_method->thumbnail);
        $this->assertSame("CPF", $customer_card->cardholder->identification->type);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Customer/customer_card_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new CustomerCardClient();
        $customer_id = "98765432-nfd98efh6u";
        $card_id = "1562188766852";
        $customer_card = $client->get($customer_id, $card_id);
        $this->assertSame(201, $customer_card->getResponse()->getStatusCode());
        $this->assertSame("1562188766852", $customer_card->id);
        $this->assertSame(6, $customer_card->expiration_month);
        $this->assertSame("credit_card", $customer_card->payment_method->payment_type_id);
        $this->assertSame("http://img.mlstatic.com/org-img/MP3/API/logos/visa.gif", $customer_card->payment_method->thumbnail);
        $this->assertSame("CPF", $customer_card->cardholder->identification->type);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Customer/customer_card_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new CustomerCardClient();
        $customer_id = "98765432-nfd98efh6u";
        $card_id = "1562188766852";
        $customer_card = $client->update($customer_id, $card_id, $this->createRequest());
        $this->assertSame(201, $customer_card->getResponse()->getStatusCode());
        $this->assertSame("1562188766852", $customer_card->id);
        $this->assertSame(6, $customer_card->expiration_month);
        $this->assertSame("credit_card", $customer_card->payment_method->payment_type_id);
        $this->assertSame("http://img.mlstatic.com/org-img/MP3/API/logos/visa.gif", $customer_card->payment_method->thumbnail);
        $this->assertSame("CPF", $customer_card->cardholder->identification->type);
    }

    public function testDeleteSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Customer/customer_card_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new CustomerCardClient();
        $customer_id = "98765432-nfd98efh6u";
        $card_id = "1562188766852";
        $customer_card = $client->delete($customer_id, $card_id);
        $this->assertSame(201, $customer_card->getResponse()->getStatusCode());
        $this->assertSame("1562188766852", $customer_card->id);
        $this->assertSame(6, $customer_card->expiration_month);
        $this->assertSame("credit_card", $customer_card->payment_method->payment_type_id);
        $this->assertSame("http://img.mlstatic.com/org-img/MP3/API/logos/visa.gif", $customer_card->payment_method->thumbnail);
        $this->assertSame("CPF", $customer_card->cardholder->identification->type);
    }

    public function testListSuccess(): void
    {
        $file_path = '../../../../Resources/Mocks/Response/Customer/customer_card_list.json';
        $mock_http_request = $this->mockHttpRequest($file_path, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new CustomerCardClient();
        $customer_id = "98765432-nfd98efh6u";
        $customer_card_result = $client->list($customer_id);
        $this->assertNotNull($customer_card_result->data);
        $this->assertSame(200, $customer_card_result->getResponse()->getStatusCode());
        $this->assertCount(2, $customer_card_result->getResponse()->getContent());
        $this->assertCount(2, $customer_card_result->data);

        $this->assertSame("1562188766851", $customer_card_result->data[0]->id);
        $this->assertSame(2023, $customer_card_result->data[0]->expiration_year);
        $this->assertSame("master", $customer_card_result->data[0]->payment_method->id);
        $this->assertSame("2019-07-03T21:15:35.000Z", $customer_card_result->data[0]->date_created);

        $this->assertSame("1562188766852", $customer_card_result->data[1]->id);
        $this->assertSame(2024, $customer_card_result->data[1]->expiration_year);
        $this->assertSame("visa", $customer_card_result->data[1]->payment_method->id);
        $this->assertSame("2019-07-03T21:15:35.000Z", $customer_card_result->data[1]->date_created);
    }

    private function createRequest(): array
    {
        $request = [
            "token" => "60aca73f30e817fcf074cebc616897ba",
        ];
        return $request;
    }
}
