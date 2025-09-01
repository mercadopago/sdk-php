<?php

namespace MercadoPago\Tests\Client\Unit\Preference;

use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * Preference Client unit tests.
 */
final class PreferenceClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Preference/preference_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreferenceClient();
        $preference = $client->create($this->createRequest());

        $this->assertSame(201, $preference ->getResponse()->getStatusCode());
        $this->assertSame("111111111-31b00b3b-3572-4fbb-a090-12c1dedc4dd7", $preference -> id);
        $this->assertSame("5887075667929427", $preference -> client_id);
        $this->assertSame("2023-08-22T08:11:50.310-04:00", $preference -> date_created);
        $this->assertSame("https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=111111111-31b00b3b-3572-4fbb-a090-12c1dedc4dd7", $preference -> init_point);
        $this->assertSame("MP-MKT-5887075667929427", $preference -> marketplace);
        $this->assertSame("test_reference", $preference -> external_reference);
        $this->assertSame("test name", $preference ->payer->name);
        $this->assertSame("test surname", $preference ->payer->surname);
        $this->assertSame("4567", $preference ->items[0]->id);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Preference/preference_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreferenceClient();
        $preference_id = "111111111-31b00b3b-3572-4fbb-a090-12c1dedc4dd7";
        $preference = $client->get($preference_id);

        $this->assertSame(200, $preference->getResponse()->getStatusCode());
        $this->assertSame("111111111-31b00b3b-3572-4fbb-a090-12c1dedc4dd7", $preference -> id);
        $this->assertSame("5887075667929427", $preference -> client_id);
        $this->assertSame("2023-08-22T08:11:50.310-04:00", $preference -> date_created);
        $this->assertSame("https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=111111111-31b00b3b-3572-4fbb-a090-12c1dedc4dd7", $preference -> init_point);
        $this->assertSame("MP-MKT-5887075667929427", $preference -> marketplace);
        $this->assertSame("test_reference", $preference -> external_reference);
        $this->assertSame("test name", $preference ->payer->name);
        $this->assertSame("test surname", $preference ->payer->surname);
        $this->assertSame("4567", $preference ->items[0]->id);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Preference/preference_update.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreferenceClient();
        $preference_id = "111111111-31b00b3b-3572-4fbb-a090-12c1dedc4dd7";
        $preference = $client->update($preference_id, $this->updateRequest());

        $this->assertSame(200, $preference ->getResponse()->getStatusCode());
        $this->assertSame("111111111-31b00b3b-3572-4fbb-a090-12c1dedc4dd7", $preference -> id);
        $this->assertSame("https://www.test.com", $preference -> notification_url);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Preference/preference_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PreferenceClient();
        $search_request = new \MercadoPago\Net\MPSearchRequest(5, 0, ["external_reference" => "998476493"]);
        $search_result = $client->search($search_request);

        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(1, count($search_result->elements));
        $this->assertSame("11111111-fd23cead-c53a-43d1-946c-4afef6f806f6", $search_result -> elements[0]->id);
        $this->assertSame(1, $search_result->next_offset);
        $this->assertSame(1, $search_result->total);
    }

    private function createRequest(): array
    {
        $request = [
          "external_reference" => "",
          "items" => array(
            array(
              "id" => "4567",
              "title" => "Test",
              "description" => "Test",
              "picture_url" => "http://i.mlcdn.com.br/portaldalu/fotosconteudo/48029_01.jpg",
              "category_id" => "eletronico",
              "quantity" => 2,
              "currency_id" => "BRL",
              "unit_price" => 5.00
            )
          ),
          "payment_methods" => [
            "default_payment_method_id" => "master",
            "excluded_payment_types" => array(
              array(
                "id" => "ticket"
              )
            ),
            "installments"  => 12,
            "default_installments" => 1
          ]
        ];
        return $request;
    }

    private function updateRequest(): array
    {
        $request = [
          "notification_url" => "https://www.test.com"
        ];
        return $request;
    }
}
