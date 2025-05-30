<?php

namespace Tests\MercadoPago\Client\Unit\Chargeback;

use MercadoPago\Client\Chargeback\ChargebackClient;
use MercadoPago\Net\MPSearchRequest;
use Tests\MercadoPago\Client\Unit\Base\BaseClient;

/**
 * ChargebackClient unit tests.
 */
final class ChargebackClientUnitTest extends BaseClient
{
    public function testGetSuccess(): void
    {
        $filePath = '../../../../Resources/Mocks/Response/Chargeback/chargeback_base.json';
        $chargeback = $this->getClient($filePath, 200)->get("123456");
        $this->assertSame("123456", $chargeback->id);
        $this->assertSame(987654321, $chargeback->payment_id);
        $this->assertSame(100.0, $chargeback->amount);
        $this->assertSame("BRL", $chargeback->currency);
        $this->assertSame("fraud", $chargeback->reason);
        $this->assertSame("chargeback", $chargeback->stage);
        $this->assertSame("open", $chargeback->status);
    }

    public function testSearchSuccess(): void
    {
        $filePath = '../../../../Resources/Mocks/Response/Chargeback/chargeback_search.json';
        $filters = array("payment_id" => "987654321");
        $search_request = new MPSearchRequest($filters);
        $search_result = $this->getClient($filePath, 200)->search($search_request);
        
        $this->assertSame(1, $search_result->paging->total);
        $this->assertSame(1, count($search_result->results));
        $this->assertSame("123456", $search_result->results[0]->id);
        $this->assertSame(987654321, $search_result->results[0]->payment_id);
    }

    private function getClient(string $filePath, int $statusCode): ChargebackClient
    {
        $responseBody = file_get_contents(__DIR__ . $filePath);
        $httpClient = $this->createHttpClientMock($statusCode, $responseBody);
        return new ChargebackClient($httpClient);
    }
} 