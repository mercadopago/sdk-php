<?php

namespace MercadoPago\Tests\Client\Unit\OAuth;

use MercadoPago\Client\OAuth\OAuthClient;
use MercadoPago\Client\OAuth\OAuthCreateRequest;
use MercadoPago\Client\OAuth\OAuthRefreshRequest;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * OAuthClient unit tests.
 */
final class OAuthClientUnitTest extends BaseClient
{
    public function testGetAuthorizationURLSuccess(): void
    {
        $client = new OAuthClient();
        $url = $client->getAuthorizationURL("app_id", "redirect_uri", "random_id");
        $expected = "https://auth.mercadopago.com?client_id=app_id&response_type=code&platform_id=mp&state=random_id&redirect_uri=redirect_uri";
        $this->assertSame($expected, $url);
    }

    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/OAuth/oauth_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new OAuthClient();
        $oauth = $client->create($this->createRequest());
        $this->assertSame(200, $oauth->getResponse()->getStatusCode());
        $this->assertSame("APP_USR-367604750109681-091211-fbad3ab32ad4f89bf1c385141ba5626a-1160535239", $oauth->access_token);
        $this->assertSame("Bearer", $oauth->token_type);
        $this->assertSame(15552000, $oauth->expires_in);
        $this->assertSame("offline_access read write", $oauth->scope);
        $this->assertSame(1160535239, $oauth->user_id);
        $this->assertSame("TG-6500883a5f70750001bc46d2-1160535239", $oauth->refresh_token);
        $this->assertSame("APP_USR-2dfd505a-4b30-4403-878b-f8fb618e58b3", $oauth->public_key);
        $this->assertTrue($oauth->live_mode);
    }

    public function testRefreshSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/OAuth/oauth_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new OAuthClient();
        $oauth = $client->refresh($this->refreshRequest());
        $this->assertSame(200, $oauth->getResponse()->getStatusCode());
        $this->assertSame("APP_USR-367604750109681-091211-fbad3ab32ad4f89bf1c385141ba5626a-1160535239", $oauth->access_token);
        $this->assertSame("Bearer", $oauth->token_type);
        $this->assertSame(15552000, $oauth->expires_in);
        $this->assertSame("offline_access read write", $oauth->scope);
        $this->assertSame(1160535239, $oauth->user_id);
        $this->assertSame("TG-6500883a5f70750001bc46d2-1160535239", $oauth->refresh_token);
        $this->assertSame("APP_USR-2dfd505a-4b30-4403-878b-f8fb618e58b3", $oauth->public_key);
        $this->assertTrue($oauth->live_mode);
    }

    private function createRequest(): OAuthCreateRequest
    {
        $request = new OAuthCreateRequest();
        $request->client_secret = "CLIENT_SECRET";
        $request->client_id = "CLIENT_ID";
        $request->code = "CODE";
        $request->redirect_uri = "REDIRECT_URI";
        return $request;
    }

    private function refreshRequest(): OAuthRefreshRequest
    {
        $request = new OAuthRefreshRequest();
        $request->client_secret = "CLIENT_SECRET";
        $request->client_id = "CLIENT_ID";
        $request->refresh_token = "REFRESH_TOKEN";
        return $request;
    }
}
