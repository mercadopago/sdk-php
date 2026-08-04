<?php

namespace MercadoPago\Tests\Client\Unit\Ergonomia;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Exceptions\MPAuthenticationException;
use MercadoPago\Exceptions\MPBadRequestException;
use MercadoPago\Exceptions\MPConnectionException;
use MercadoPago\Exceptions\MPDependencyException;
use MercadoPago\Exceptions\MPForbiddenException;
use MercadoPago\Exceptions\MPIdempotencyException;
use MercadoPago\Exceptions\MPNotFoundException;
use MercadoPago\Exceptions\MPPaymentException;
use MercadoPago\Exceptions\MPRateLimitException;
use MercadoPago\Exceptions\MPResourceLockedException;
use MercadoPago\Exceptions\MPServerException;
use MercadoPago\Exceptions\MPValidationException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Net\MPResponse;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for typed exception hierarchy and retry config (TASK-007, TASK-009).
 */
final class TypedExceptionTest extends TestCase
{
    // ─── Exception subtype hierarchy ─────────────────────────────────────────

    public function testAllSubtypesExtendMPApiException(): void
    {
        $response = new MPResponse(400, []);
        $this->assertInstanceOf(MPApiException::class, new MPBadRequestException('', $response));
        $this->assertInstanceOf(MPApiException::class, new MPAuthenticationException('', $response));
        $this->assertInstanceOf(MPApiException::class, new MPPaymentException('', $response));
        $this->assertInstanceOf(MPApiException::class, new MPForbiddenException('', $response));
        $this->assertInstanceOf(MPApiException::class, new MPNotFoundException('', $response));
        $this->assertInstanceOf(MPApiException::class, new MPIdempotencyException('', $response));
        $this->assertInstanceOf(MPApiException::class, new MPValidationException('', $response));
        $this->assertInstanceOf(MPApiException::class, new MPResourceLockedException('', $response));
        $this->assertInstanceOf(MPApiException::class, new MPDependencyException('', $response));
        $this->assertInstanceOf(MPApiException::class, new MPServerException('', $response));
        $this->assertInstanceOf(MPApiException::class, new MPRateLimitException('', $response));
    }

    public function testMPRateLimitExceptionStoresRetryAfter(): void
    {
        $response = new MPResponse(429, []);
        $ex = new MPRateLimitException('', $response, 45);
        $this->assertSame(45, $ex->getRetryAfter());
    }

    public function testMPRateLimitExceptionNullRetryAfter(): void
    {
        $response = new MPResponse(429, []);
        $ex = new MPRateLimitException('', $response);
        $this->assertNull($ex->getRetryAfter());
    }

    public function testMPConnectionExceptionExtendsBaseException(): void
    {
        $ex = new MPConnectionException('network error');
        $this->assertInstanceOf(\Exception::class, $ex);
    }

    // ─── Factory: status code → subtype mapping ───────────────────────────────

    private function factoryExceptionForStatus(int $status_code): MPApiException
    {
        $mock = $this->getMockBuilder(\MercadoPago\Net\HttpRequest::class)->getMock();
        $mock->method('execute')->willReturn('{}');
        $mock->method('getInfo')->willReturn($status_code);

        $http_client = new MPDefaultHttpClient($mock);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentClient();
        try {
            $client->get(1);
            $this->fail("Expected MPApiException for status $status_code");
        } catch (MPApiException $e) {
            return $e;
        }
    }

    public function testFactory400ReturnsMPBadRequestException(): void
    {
        $this->assertInstanceOf(MPBadRequestException::class, $this->factoryExceptionForStatus(400));
    }

    public function testFactory401ReturnsMPAuthenticationException(): void
    {
        $this->assertInstanceOf(MPAuthenticationException::class, $this->factoryExceptionForStatus(401));
    }

    public function testFactory402ReturnsMPPaymentException(): void
    {
        $this->assertInstanceOf(MPPaymentException::class, $this->factoryExceptionForStatus(402));
    }

    public function testFactory403ReturnsMPForbiddenException(): void
    {
        $this->assertInstanceOf(MPForbiddenException::class, $this->factoryExceptionForStatus(403));
    }

    public function testFactory404ReturnsMPNotFoundException(): void
    {
        $this->assertInstanceOf(MPNotFoundException::class, $this->factoryExceptionForStatus(404));
    }

    public function testFactory409ReturnsMPIdempotencyException(): void
    {
        $this->assertInstanceOf(MPIdempotencyException::class, $this->factoryExceptionForStatus(409));
    }

    public function testFactory422ReturnsMPValidationException(): void
    {
        $this->assertInstanceOf(MPValidationException::class, $this->factoryExceptionForStatus(422));
    }

    public function testFactory423ReturnsMPResourceLockedException(): void
    {
        $this->assertInstanceOf(MPResourceLockedException::class, $this->factoryExceptionForStatus(423));
    }

    public function testFactory424ReturnsMPDependencyException(): void
    {
        $this->assertInstanceOf(MPDependencyException::class, $this->factoryExceptionForStatus(424));
    }

    public function testFactory429ReturnsMPRateLimitException(): void
    {
        $this->assertInstanceOf(MPRateLimitException::class, $this->factoryExceptionForStatus(429));
    }

    public function testFactory500ReturnsMPServerException(): void
    {
        $this->assertInstanceOf(MPServerException::class, $this->factoryExceptionForStatus(500));
    }

    public function testFactoryUnknownClientErrorReturnsMPApiException(): void
    {
        $ex = $this->factoryExceptionForStatus(418);
        $this->assertSame(MPApiException::class, get_class($ex));
    }

    public function testCatchByBaseTypeCatchesSubtype(): void
    {
        $response = new MPResponse(401, []);
        $ex = new MPAuthenticationException('', $response);
        $caught = false;
        try {
            throw $ex;
        } catch (MPApiException $e) {
            $caught = true;
        }
        $this->assertTrue($caught);
    }

    // ─── RequestOptions retry config ─────────────────────────────────────────

    public function testDefaultConstantsExposed(): void
    {
        $this->assertSame(3, RequestOptions::DEFAULT_MAX_RETRIES);
        $this->assertSame(60000, RequestOptions::DEFAULT_TIMEOUT_MS);
        $this->assertSame(30000, RequestOptions::DEFAULT_MAX_DELAY_MS);
        $this->assertSame([429, 500, 502, 503, 504], RequestOptions::DEFAULT_RETRY_ON);
    }

    public function testSetMaxRetriesNegativeThrowsInvalidArgument(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $opts = new RequestOptions();
        $opts->setMaxRetries(-1);
    }

    public function testSetInitialDelayMsNegativeThrowsInvalidArgument(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $opts = new RequestOptions();
        $opts->setInitialDelayMs(-100);
    }

    public function testSetMaxDelayMsNegativeThrowsInvalidArgument(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $opts = new RequestOptions();
        $opts->setMaxDelayMs(-1);
    }

    public function testSetRetryOnInvalidCodeThrowsInvalidArgument(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $opts = new RequestOptions();
        $opts->setRetryOn([999]);
    }

    public function testSetValidRetryOnAccepted(): void
    {
        $opts = new RequestOptions();
        $opts->setRetryOn([429, 503]);
        $this->assertSame([429, 503], $opts->getRetryOn());
    }

    public function testSetOnRetryCallback(): void
    {
        $opts = new RequestOptions();
        $called = false;
        $opts->setOnRetry(function (int $attempt, \Throwable $e) use (&$called) {
            $called = true;
        });
        $this->assertNotNull($opts->getOnRetry());
    }

    // ─── Auto-pagination ─────────────────────────────────────────────────────

    public function testPaymentClientHasSearchAllMethod(): void
    {
        $this->assertTrue(method_exists(PaymentClient::class, 'searchAll'));
    }

    public function testSearchAllReturnsGenerator(): void
    {
        $mock = $this->getMockBuilder(\MercadoPago\Net\HttpRequest::class)->getMock();
        $json = file_get_contents(__DIR__ . '/../../../Resources/Mocks/Response/Payment/payment_search.json');
        $mock->method('execute')->willReturn($json);
        $mock->method('getInfo')->willReturn(200);

        $http_client = new MPDefaultHttpClient($mock);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentClient();
        $request = new \MercadoPago\Net\MPSearchRequest(5, 0);
        $gen = $client->searchAll($request);
        $this->assertInstanceOf(\Generator::class, $gen);
    }
}
