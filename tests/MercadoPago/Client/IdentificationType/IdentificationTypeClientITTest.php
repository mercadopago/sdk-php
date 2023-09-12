<?php

namespace MercadoPago\Tests\Client\Customer;

use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\IdentificationType\IdentificationTypeClient;
use PHPUnit\Framework\TestCase;

/**
 * Identification Type Client integration tests.
 */
final class IdentificationTypeClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testListSuccess(): void
    {
        $client = new IdentificationTypeClient();
        $identification_type = $client->list();
        $this->assertNotNull($identification_type->data);
        $this->assertEquals(200, $identification_type->getResponse()->getStatusCode());
        $this->assertCount(2, $identification_type->getResponse()->getContent());
        $this->assertCount(2, $identification_type->data);
        $this->assertNotNull($identification_type->data[0]["id"]);
        $this->assertEquals("CPF", $identification_type->data[0]["id"]);
        $this->assertEquals("CNPJ", $identification_type->data[1]["id"]);
    }

    public function testListWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new IdentificationTypeClient();
        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->list($request_options);
    }
}
