<?php

namespace MercadoPago\Tests\Client\Integration\Preference;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;
use PHPUnit\Framework\TestCase;

/**
 * PreferenceClient integration tests.
 */
final class PreferenceClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        $client = new PreferenceClient();
        $preference = $client->create($this->createRequest());
        $this->assertNotNull($preference->id);
    }

    public function testCreateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PreferenceClient();
        $request = $this->createRequest();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->create($request, $request_options);
    }

    public function testGetSuccess(): void
    {
        $client = new PreferenceClient();
        $created_preference = $client->create($this->createRequest());
        $preference = $client->get($created_preference->id);
        $this->assertNotNull($preference->id);
        $this->assertNotNull($preference->init_point);
    }

    public function testGetWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PreferenceClient();
        $created_preference = $client->create($this->createRequest());
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->get($created_preference->id, $request_options);
    }

    public function testUpdateSuccess(): void
    {
        $client = new PreferenceClient();
        $created_preference = $client->create($this->createRequest());
        $preference = $client->update($created_preference->id, $this->updateRequest());
        $this->assertSame("https://www.test.com", $preference->notification_url);
    }

    public function testUpdateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PreferenceClient();
        $created_preference = $client->create($this->createRequest());
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->update($created_preference->id, $this->updateRequest(), $request_options);
    }

    public function testSearchSuccess(): void
    {
        $client = new PreferenceClient();

        $request = $this->createRequest();
        $external_reference = strval(rand());
        $request["external_reference"] = $external_reference;
        $created_preference = $client->create($request);

        sleep(3);
        $search_request = new MPSearchRequest(1, 0, ["external_reference" => $external_reference]);
        $search_result = $client->search($search_request);
        $this->assertSame(1, $search_result->next_offset);
        $this->assertSame(1, $search_result->total);
        $this->assertSame(1, count($search_result->elements));
        $this->assertNotNull($search_result->elements[0]->id);
        $this->assertSame($created_preference->external_reference, $search_result->elements[0]->external_reference);
    }

    public function testSearchWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PreferenceClient();
        $created_preference = $client->create($this->createRequest());
        $search_request = new MPSearchRequest(1, 0, ["id" => $created_preference->id]);
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->search($search_request, $request_options);
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
