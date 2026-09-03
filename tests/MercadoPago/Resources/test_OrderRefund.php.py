<?php

namespace MercadoPago\Tests\Resources;

use MercadoPago\Resources\OrderRefund;
use MercadoPago\Serialization\Serializer;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for the OrderRefund resource model.
 */
class OrderRefundTest extends TestCase
{
    /**
     * Test that OrderRefund can be deserialized from a minimal JSON response.
     */
    public function testDeserializeMinimalRefund(): void
    {
        $json = [
            'id' => 'refund-123456',
            'status' => 'refunded',
            'status_detail' => 'refunded_total',
        ];

        $refund = Serializer::deserializeFromJson(OrderRefund::class, $json);

        $this->assertInstanceOf(OrderRefund::class, $refund);
        $this->assertSame('refund-123456', $refund->id);
        $this->assertSame('refunded', $refund->status);
        $this->assertSame('refunded_total', $refund->status_detail);
        $this->assertNull($refund->transactions);
    }

    /**
     * Test that OrderRefund can be deserialized with nested transactions.
     */
    public function testDeserializeWithTransactions(): void
    {
        $json = [
            'id' => 'refund-999',
            'status' => 'refunded',
            'status_detail' => 'refunded_partial',
            'transactions' => [
                'refunds' => [
                    [
                        'id' => '111',
                        'amount' => '50.00',
                    ],
                ],
            ],
        ];

        $refund = Serializer::deserializeFromJson(OrderRefund::class, $json);

        $this->assertInstanceOf(OrderRefund::class, $refund);
        $this->assertSame('refund-999', $refund->id);
        $this->assertSame('refunded', $refund->status);
        $this->assertSame('refunded_partial', $refund->status_detail);
        $this->assertNotNull($refund->transactions);
    }

    /**
     * Test that OrderRefund properties default to null when not present in JSON.
     */
    public function testDeserializeEmptyJson(): void
    {
        $json = [];

        $refund = Serializer::deserializeFromJson(OrderRefund::class, $json);

        $this->assertInstanceOf(OrderRefund::class, $refund);
        $this->assertNull($refund->id);
        $this->assertNull($refund->status);
        $this->assertNull($refund->status_detail);
        $this->assertNull($refund->transactions);
    }

    /**
     * Test that getMap returns the correct mapping array.
     */
    public function testGetMap(): void
    {
        $refund = new OrderRefund();
        $map = $refund->getMap();

        $this->assertIsArray($map);
        $this->assertArrayHasKey('transactions', $map);
        $this->assertSame('MercadoPago\Resources\Order\Transactions', $map['transactions']);
    }
}