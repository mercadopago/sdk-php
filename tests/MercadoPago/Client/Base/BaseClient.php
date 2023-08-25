<?php

namespace MercadoPago\Client\Base;

use PHPUnit\Framework\TestCase;

/**
 * Base Client.
 */
abstract class BaseClient extends TestCase
{
    protected function mockHttpRequest(string $filepath, int $status_code): \PHPUnit\Framework\MockObject\MockObject|\MercadoPago\Net\HttpRequest
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject|\MercadoPago\Net\HttpRequest $mockHttpRequest */
        $mockHttpRequest = $this->getMockBuilder(\MercadoPago\Net\HttpRequest::class)->getMock();

        $responseJson = file_get_contents(__DIR__ . $filepath);
        $mockHttpRequest->method('execute')->willReturn($responseJson);
        $mockHttpRequest->method('getInfo')->willReturn($status_code);
        return $mockHttpRequest;
    }
}
