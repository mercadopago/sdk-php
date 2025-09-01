<?php

namespace MercadoPago\Tests\Client\Integration\Customer;

use MercadoPago\Client\CardToken\CardTokenClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Customer\CustomerCardClient;
use MercadoPago\Client\Customer\CustomerClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use PHPUnit\Framework\TestCase;

/**
 * Customer Card Client integration tests.
 */
final class CustomerCardClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        $client_customer = new CustomerClient();
        $id = rand(100000, 200000);
        $email = sprintf("test_user_sdk_%s@testuser.com", $id);
        $customer = $client_customer->create($this->createRequest($email));
        $this->assertNotNull($customer->id);

        $client_token = new CardTokenClient();
        $card_token = $client_token->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $request = ["token" => $card_token->id];
        $client = new CustomerCardClient();
        $customer_card = $client->create($customer->id, $request);
        $this->assertNotNull($customer_card->id);
    }

    public function testCreateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CustomerCardClient();
        $request = ["token" => "abcd1234"];
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->create("1469979538-52qKdADBYeloaX", $request, $request_options);
    }

    public function testGetSuccess(): void
    {
        $client_customer = new CustomerClient();
        $id = rand(100000, 200000);
        $email = sprintf("test_user_sdk_%s@testuser.com", $id);
        $customer = $client_customer->create($this->createRequest($email));
        $this->assertNotNull($customer->id);

        $client_token = new CardTokenClient();
        $card_token = $client_token->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $request = ["token" => $card_token->id];
        $client = new CustomerCardClient();
        $created_customer_card = $client->create($customer->id, $request);
        $this->assertNotNull($created_customer_card->id);

        $get_customer_card = $client->get($customer->id, $created_customer_card->id);
        $this->assertNotNull($get_customer_card->id);
    }

    public function testGetWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CustomerCardClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->get("1469979538-52qKdADBYeloaX", "abcd1234", $request_options);
    }

    public function testUpdateSuccess(): void
    {
        $client_customer = new CustomerClient();
        $id = rand(100000, 200000);
        $email = sprintf("test_user_sdk_%s@testuser.com", $id);
        $customer = $client_customer->create($this->createRequest($email));
        $this->assertNotNull($customer->id);

        $client_token = new CardTokenClient();
        $card_token = $client_token->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $request = ["token" => $card_token->id];
        $client = new CustomerCardClient();
        $customer_card = $client->create($customer->id, $request);
        $this->assertNotNull($customer_card->id);

        $request_update = ["expiration_year" => 2026];
        $update_customer = $client->update($customer->id, $customer_card->id, $request_update);
        $this->assertSame(2026, $update_customer->expiration_year);
    }

    public function testUpdateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CustomerCardClient();
        $request_update = ["expiration_year" => 2026];
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->update("1469979538-52qKdADBYeloaX", "1234abcd", $request_update, $request_options);
    }

    public function testDeleteSuccess(): void
    {
        $client_customer = new CustomerClient();
        $id = rand(100000, 200000);
        $email = sprintf("test_user_sdk_%s@testuser.com", $id);
        $customer = $client_customer->create($this->createRequest($email));
        $this->assertNotNull($customer->id);

        $client_token = new CardTokenClient();
        $card_token = $client_token->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $request = ["token" => $card_token->id];
        $client = new CustomerCardClient();
        $customer_card = $client->create($customer->id, $request);
        $this->assertNotNull($customer_card->id);

        $delete_customer = $client->delete($customer->id, $customer_card->id);
        $this->assertNotNull($delete_customer->id);
    }

    public function testDeleteWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CustomerCardClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->delete("1469979538-52qKdADBYeloaX", "1234abcd", $request_options);
    }

    public function testListSuccess(): void
    {
        $client_customer = new CustomerClient();
        $id = rand(100000, 200000);
        $email = sprintf("test_user_sdk_%s@testuser.com", $id);
        $customer = $client_customer->create($this->createRequest($email));
        $this->assertNotNull($customer->id);

        $client_token = new CardTokenClient();
        $card_token = $client_token->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        $request = ["token" => $card_token->id];
        $client = new CustomerCardClient();
        $created_customer_card = $client->create($customer->id, $request);
        $this->assertNotNull($created_customer_card->id);

        $get_customer_card = $client->list($customer->id);
        $this->assertNotNull($get_customer_card->data);
        $this->assertSame(200, $get_customer_card->getResponse()->getStatusCode());
        $this->assertCount(1, $get_customer_card->getResponse()->getContent());
        $this->assertCount(1, $get_customer_card->data);
        $this->assertNotNull($get_customer_card->data[0]->id);
    }

    public function testListWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CustomerCardClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->list("1469979538-52qKdADBYeloaX", $request_options);
    }

    private function createRequest(string $email): array
    {
        $request = [
            "email" => $email
        ];
        return $request;
    }

    private function createCardTokenRequest(): array
    {
        $request = [
            "card_number" => "5031433215406351",
            "expiration_year" => "2025",
            "expiration_month" => "12",
            "security_code" => "123",
            "cardholder" => [
                "name" => "APRO",
                "identification" => [
                    "type" => "CPF",
                    "number" => "19119119100",
                ],
            ]
        ];
        return $request;
    }
}
