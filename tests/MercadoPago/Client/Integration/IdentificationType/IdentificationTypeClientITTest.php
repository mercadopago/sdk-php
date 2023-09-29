<?php

namespace MercadoPago\Tests\Client\Integration\IdentificationType;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\IdentificationType\IdentificationTypeClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
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
        $this->assertSame(200, $identification_type->getResponse()->getStatusCode());
        $this->assertCount(2, $identification_type->getResponse()->getContent());
        $this->assertCount(2, $identification_type->data);
        $this->assertNotNull($identification_type->data[0]->id);
        $this->assertSame("CPF", $identification_type->data[0]->id);
        $this->assertSame("CNPJ", $identification_type->data[1]->id);
    }

    public function testListWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new IdentificationTypeClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->list($request_options);
    }
}
