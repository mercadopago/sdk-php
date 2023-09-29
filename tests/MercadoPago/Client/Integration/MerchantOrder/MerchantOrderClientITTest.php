<?php

namespace MercadoPago\Tests\Client\Integration\MerchantOrder;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MerchantOrder\MerchantOrderClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;
use PHPUnit\Framework\TestCase;

/**
 * Merchant Order Client integration tests.
 */
final class MerchantOrderClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        $client_preference = new PreferenceClient();
        $preference = $client_preference->create($this->createPreferenceRequest());
        $this->assertNotNull($preference->id);

        $client = new MerchantOrderClient();
        $merchant_order = $client->create($this->createRequest($preference->id));
        $this->assertNotNull($merchant_order->id);
    }

    public function testCreateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new MerchantOrderClient();
        $request = $this->createRequest("");
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->create($request, $request_options);
    }

    public function testGetSuccess(): void
    {
        $client_preference = new PreferenceClient();
        $preference = $client_preference->create($this->createPreferenceRequest());
        $this->assertNotNull($preference->id);

        $client = new MerchantOrderClient();
        $merchant_order_created = $client->create($this->createRequest($preference->id));
        $this->assertNotNull($merchant_order_created->id);

        $merchant_order_getted = $client->get($merchant_order_created->id);
        $this->assertNotNull($merchant_order_getted->id);
        $this->assertSame("test_reference", $merchant_order_getted->external_reference);
    }

    public function testGetWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new MerchantOrderClient();
        $created_merchantorder = $client->create($this->createRequest(""));
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->get($created_merchantorder->id, $request_options);
    }

    public function testUpdateSuccess(): void
    {
        $client_preference = new PreferenceClient();
        $preference = $client_preference->create($this->createPreferenceRequest());
        $this->assertNotNull($preference->id);

        $client = new MerchantOrderClient();
        $merchant_order_created = $client->create($this->createRequest($preference->id));
        $this->assertNotNull($merchant_order_created->id);

        $merchant_order_updated = $client->update($merchant_order_created->id, $this->updateRequest());
        $this->assertNotNull($merchant_order_updated->id);
        $this->assertSame("https://www.test.com", $merchant_order_updated->notification_url);
    }

    public function testUpdateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new MerchantOrderClient();
        $created_merchantorder = $client->create($this->createRequest(""));
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->update($created_merchantorder->id, $this->updateRequest(), $request_options);
    }

    public function testSearchSuccess(): void
    {
        $client_preference = new PreferenceClient();
        $preference = $client_preference->create($this->createPreferenceRequest());
        $this->assertNotNull($preference->id);

        $client = new MerchantOrderClient();
        $merchant_order_created = $client->create($this->createRequest($preference->id));
        $this->assertNotNull($merchant_order_created->id);

        sleep(3);
        $search_request = new MPSearchRequest(1, 0, ["preference_id" => $preference->id]);
        $search_result = $client->search($search_request);
        $this->assertSame(1, $search_result->next_offset);
        $this->assertSame(1, $search_result->total);
        $this->assertSame(1, count($search_result->elements));
        $this->assertSame($merchant_order_created->id, $search_result->elements[0]->id);
    }

    public function testSearchWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new MerchantOrderClient();
        $created_merchantorder = $client->create($this->createRequest(""));
        $search_request = new MPSearchRequest(1, 0, ["id" => $created_merchantorder->id]);
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->search($search_request, $request_options);
    }

    private function createRequest(string $preference_id): array
    {
        $request = [
            "external_reference" => "test_reference",
            "preference_id" => $preference_id,
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

    private function createPreferenceRequest(): array
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
}
