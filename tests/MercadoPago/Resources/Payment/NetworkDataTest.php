<?php

namespace MercadoPago\Tests\Resources\Payment;

use MercadoPago\Resources\Payment\PointOfInteraction;
use MercadoPago\Resources\Payment\TransactionData;
use PHPUnit\Framework\TestCase;

final class NetworkDataTest extends TestCase
{
    public function testNetworkDataIsMappedInsideTransactionData(): void
    {
        $transactionData = new TransactionData();
        $pointOfInteraction = new PointOfInteraction();

        $this->assertSame('MercadoPago\\Resources\\Payment\\NetworkData', $transactionData->getMap()['network_data']);
        $this->assertArrayNotHasKey('network_data', $pointOfInteraction->getMap());
    }
}
