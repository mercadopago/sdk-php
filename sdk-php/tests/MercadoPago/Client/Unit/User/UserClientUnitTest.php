<?php

namespace MercadoPago\Tests\Client\Unit\User;

use MercadoPago\Client\User\UserClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * UserClientUnitTest Client unit tests.
 */
final class UserClientUnitTest extends BaseClient
{
    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/User/user_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new UserClient();
        $user = $client->get();

        $this->assertSame(200, $user->getResponse()->getStatusCode());
        $this->assertSame(1160535239, $user->id);
        $this->assertSame("TETE2893135", $user->nickname);
        $this->assertSame("2022-07-14T08:05:06.000-04:00", $user->registration_date);
        $this->assertSame("Test", $user->first_name);
        $this->assertSame("Test", $user->last_name);
        $this->assertSame("BR", $user->country_id);
        $this->assertSame("test_user_5001277@testuser.com", $user->email);
        $this->assertSame("CPF", $user->identification->type);
        $this->assertSame("15635614680", $user->identification->number);
        $this->assertSame("Test Address 123", $user->address->address);
        $this->assertSame("01", $user->phone->area_code);
        $this->assertSame("normal", $user->user_type);
        $this->assertSame("historic", $user->seller_reputation->transactions->period);
        $this->assertSame("365 days", $user->seller_reputation->metrics->sales->period);
    }
}
