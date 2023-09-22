<?php

namespace MercadoPago\Tests\Client\Unit\IdentificationType;

use MercadoPago\Client\IdentificationType\IdentificationTypeClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * Identification Type Client unit tests.
 */
final class IdentificationTypeClientUnitTest extends BaseClient
{
    public function testListSuccess(): void
    {
        $file_path = '../../../../Resources/Mocks/Response/IdentificationType/identification_type_list.json';
        $mock_http_request = $this->mockHttpRequest($file_path, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new IdentificationTypeClient();
        $identification_type_result = $client->list();
        $this->assertNotNull($identification_type_result->data);
        $this->assertEquals(200, $identification_type_result->getResponse()->getStatusCode());
        $this->assertCount(2, $identification_type_result->getResponse()->getContent());
        $this->assertCount(2, $identification_type_result->data);

        $this->assertEquals("CPF", $identification_type_result->data[0]["id"]);
        $this->assertEquals("CPF", $identification_type_result->data[0]["name"]);
        $this->assertEquals("number", $identification_type_result->data[0]["type"]);
        $this->assertEquals(11, $identification_type_result->data[0]["min_length"]);
        $this->assertEquals(11, $identification_type_result->data[0]["max_length"]);

        $this->assertEquals("CNPJ", $identification_type_result->data[1]["id"]);
        $this->assertEquals("CNPJ", $identification_type_result->data[1]["name"]);
        $this->assertEquals("number", $identification_type_result->data[1]["type"]);
        $this->assertEquals(14, $identification_type_result->data[1]["min_length"]);
        $this->assertEquals(14, $identification_type_result->data[1]["max_length"]);
    }
}
