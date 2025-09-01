<?php

namespace MercadoPago\Tests\Client\Integration\User;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\User\UserClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use PHPUnit\Framework\TestCase;

/**
 * UserClient integration tests.
 */
final class UserClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testGetSuccess(): void
    {
        $client = new UserClient();
        $user = $client->get();
        $this->assertNotNull($user->id);
        $this->assertNotNull($user->site_id);
    }

    public function testGetWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new UserClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->get($request_options);
    }
}
