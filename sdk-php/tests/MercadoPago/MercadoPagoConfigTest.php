<?php

namespace MercadoPago\Tests;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use PHPUnit\Framework\TestCase;

class MercadoPagoConfigTest extends TestCase
{
    public function testGetHttpClient()
    {
        MercadoPagoConfig::setHttpClient(new MPDefaultHttpClient());
        $this->assertInstanceOf(MPDefaultHttpClient::class, MercadoPagoConfig::getHttpClient());
    }
}
