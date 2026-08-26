<?php

namespace MercadoPago\Tests\Resources\Payment;

use MercadoPago\Resources\Payment\PointOfInteraction;
use MercadoPago\Resources\Payment\TransactionData;
use MercadoPago\Resources\Payment\ExpandedGatewayReference;
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

    public function testExpandedGatewayReferenceMapsNetworkData(): void
    {
        $reference = new ExpandedGatewayReference();

        $this->assertSame('MercadoPago\\Resources\\Payment\\NetworkData', $reference->getMap()['network_data']);
    }
}
