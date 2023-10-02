<?php

namespace MercadoPago\Tests\Client\Unit\Base;

use PHPUnit\Framework\TestCase;

/**
 * Base Client.
 */
abstract class BaseClient extends TestCase
{
    protected function mockHttpRequest(string $filepath, int $status_code): \PHPUnit\Framework\MockObject\MockObject|\MercadoPago\Net\HttpRequest
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject|\MercadoPago\Net\HttpRequest $mock_http_request */
        $mock_http_request = $this->getMockBuilder(\MercadoPago\Net\HttpRequest::class)->getMock();

        $response_json = file_get_contents(__DIR__ . $filepath);
        $mock_http_request->method('execute')->willReturn($response_json);
        $mock_http_request->method('getInfo')->willReturn($status_code);
        return $mock_http_request;
    }
}
