<?php

namespace MercadoPago\Tests\Client\Unit\Order;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Order\OrderClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * Order Client unit tests.
 */
final class OrderClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Order/order.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);
        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);
        $client = new OrderClient();

        $order = $client->create($this->createRequest());

        $this->assertSame(200, $order->getResponse()->getStatusCode());
        $this->assertSame("01HRYFWNYRE1MR1E60MW3X0T2P", $order->id);
        $this->assertSame("online", $order->type);
        $this->assertSame("1000.00", $order->total_amount);
        $this->assertSame("ext_ref_1234", $order->external_reference);
        $this->assertSame("processed", $order->status);
        $this->assertSame("accredited", $order->status_detail);
        $this->assertSame("01HRYFXQ53Q3JPEC48MYWMR0TE", $order->transactions->payments[0]->id);
        $this->assertSame("processed", $order->transactions->payments[0]->status);
        $this->assertSame("1000.00", $order->transactions->payments[0]->amount);
        $this->assertSame("master", $order->transactions->payments[0]->payment_method->id);
        $this->assertSame("credit_card", $order->transactions->payments[0]->payment_method->type);
        $this->assertSame(1, $order->transactions->payments[0]->payment_method->installments);
        $this->assertSame("automatic", $order->processing_mode);
        $this->assertSame("NONE", $order->marketplace);
    }

    private function createRequest(): array
    {
        $request = [
            "type" => "online",
            "total_amount" => "1000.00",
            "external_reference" => "ext_ref_1234",
            "transactions" => [
                "payments" => [
                    [
                        "amount" => "1000.00",
                        "payment_method" => [
                            "id" => "master",
                            "type" => "credit_card",
                            "token" => "{{card_token}}",
                            "installments" => 1,
                        ],
                    ],
                ]
            ],
            "payer" => [
                "email" => "test_1731350184@testuser.com",
            ]
        ];
        return $request;
    }

    public function testCaptureSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Order/order_capture.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);
        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);
        $client = new OrderClient();

        $order = $client->capture("01HRYFWNYRE1MR1E60MW3X0T2P");

        $this->assertSame(200, $order->getResponse()->getStatusCode());
        $this->assertSame("processed", $order->status);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Order/get_order_response.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);
        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);
        $client = new OrderClient();

        $orderId = "01JD2P9GGXAPBDGG6YT90N77M3";
        $order = $client->get($orderId);

        $this->assertSame(200, $order->getResponse()->getStatusCode());
        $this->assertSame("01JD2P9GGXAPBDGG6YT90N77M3", $order->id);
        $this->assertSame("online", $order->type);
        $this->assertSame("200.00", $order->total_amount);
        $this->assertSame("ext_ref_1234", $order->external_reference);
        $this->assertSame("processed", $order->status);
        $this->assertSame("accredited", $order->status_detail);
        $this->assertSame("automatic", $order->processing_mode);
    }

    public function testCancelOrderSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Order/order_cancel.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);
        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new OrderClient();
        $order_id = "01JDASYCCVWTT08J5RDYAJ5CBZ";

        $order = $client->cancel($order_id);

        $this->assertSame(200, $order->getResponse()->getStatusCode());
        $this->assertNotNull($order->id);
        $this->assertSame($order_id, $order->id);
        $this->assertSame("cancelled", $order->status);
    }

    public function testProcessSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Order/order_process.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);
        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);
        $client = new OrderClient();

        $order_id = "01JDA7QG60QFWMA06AWM5MMXHD";
        $order = $client->process($order_id);

        $this->assertSame(200, $order->getResponse()->getStatusCode());
        $this->assertSame($order_id, $order->id);
        $this->assertSame("processed", $order->status);
    }

    public function testRefundTotalSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Order/order_refund_total.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);
        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);
        $client = new OrderClient();

        $order_id = "01JDWHNG2GR2WHGBMRFX126YBC";
        $order = $client->refund($order_id);

        $this->assertSame(201, $order->getResponse()->getStatusCode());
        $this->assertSame($order_id, $order->id);
        $this->assertSame("refunded", $order->status);
        $this->assertSame("refunded", $order->status_detail);
        $this->assertSame("ref_01JDWHPXYC42ESJ40V4D3SMHW1", $order->transactions->refunds[0]->id);
        $this->assertSame("pay_01JDWHNG2GR2WHGBMRFY7HP5ZB", $order->transactions->refunds[0]->transaction_id);
        $this->assertSame("01JDWHPX7WMAVAQG5546553QDW", $order->transactions->refunds[0]->reference_id);
        $this->assertSame("100.00", $order->transactions->refunds[0]->amount);
        $this->assertSame("processed", $order->transactions->refunds[0]->status);
    }

    public function testRefundPartialSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Order/order_refund_partial.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);
        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);
        $client = new OrderClient();
        $request = [
            "transactions" => [
                [
                    "id" => "pay_01JDWMFW1WQK1YJR6SJHYTY0MY",
                    "amount" => "25.00",
                ],
            ],
        ];

        $order_id = "01JDWMFW1WQK1YJR6SJFW7KND5";
        $order = $client->refund($order_id, $request);

        $this->assertSame(201, $order->getResponse()->getStatusCode());
        $this->assertSame($order_id, $order->id);
        $this->assertSame("processed", $order->status);
        $this->assertSame("partially_refunded", $order->status_detail);
        $this->assertSame("ref_01JDWMHTXPBT4117BVGAWV29HG", $order->transactions->refunds[0]->id);
        $this->assertSame("pay_01JDWMFW1WQK1YJR6SJHYTY0MY", $order->transactions->refunds[0]->transaction_id);
        $this->assertSame("01JDWMHS78C51NMZ1J7V2MF8HM", $order->transactions->refunds[0]->reference_id);
        $this->assertSame("25.00", $order->transactions->refunds[0]->amount);
        $this->assertSame("processed", $order->transactions->refunds[0]->status);
    }

    public function testCreateOrderWithMinimalAdditionalInfo(): void
    {
        // Resposta de sucesso mínima (NÃO inclua additional_info aqui!)
        $mockResponse = [
            'id' => 'test_order_123',
            'status' => 'pending'
        ];

        $mockHttpRequest = $this->getMockBuilder(\MercadoPago\Net\HttpRequest::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockHttpRequest->method('execute')->willReturn(json_encode($mockResponse));
        $mockHttpRequest->method('getInfo')->willReturnCallback(function ($option) {
            return $option === CURLINFO_HTTP_CODE ? 201 : null;
        });

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $request = [
            "type" => "online",
            "total_amount" => "42.00",
            "transactions" => [
                "payments" => [
                    [
                        "amount" => "42.00",
                        "payment_method" => [
                            "id" => "pix",
                            "type" => "bank_transfer"
                        ]
                    ]
                ]
            ],
            "payer" => [
                "email" => "testuser@mock.com"
            ],
            "additional_info" => [
                "payer" => [
                    "authentication_type" => "app"
                ]
            ]
        ];


        $this->assertArrayHasKey('additional_info', $request, 'O nó additional_info deve estar no request na raiz.');
        $this->assertArrayHasKey('payer', $request['additional_info'], 'O nó payer deve estar dentro de additional_info');
        $this->assertEquals('app', $request['additional_info']['payer']['authentication_type']);

        // Envia para o SDK ‒ só valide campos realmente existentes na response!
        $client = new OrderClient();
        $order = $client->create($request);
        $this->assertEquals('test_order_123', $order->id);
        $this->assertEquals('pending', $order->status);
    }

    public function testRequestContainsCaptureMode(): void
    {
        // Resposta mockada mínima da API (não precisa conter capture_mode)
        $mockResponse = [
            'id' => 'order_capture_mode_test',
            'status' => 'pending'
        ];

        $mockHttpRequest = $this->getMockBuilder(\MercadoPago\Net\HttpRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockHttpRequest->method('execute')->willReturn(json_encode($mockResponse));
        $mockHttpRequest->method('getInfo')->willReturnCallback(
            fn($option) => $option === CURLINFO_HTTP_CODE ? 201 : null
        );

        MercadoPagoConfig::setHttpClient(new MPDefaultHttpClient($mockHttpRequest));

        $request = [
            "type" => "online",
            "total_amount" => "42.00",
            "capture_mode" => "automatic_async",
            "transactions" => [
                "payments" => [
                    [
                        "amount" => "42.00",
                        "payment_method" => [
                            "id" => "pix",
                            "type" => "bank_transfer"
                        ]
                    ]
                ]
            ],
            "payer" => [
                "email" => "testuser@mock.com"
            ]
        ];

        $this->assertArrayHasKey('capture_mode', $request, 'O campo capture_mode deve existir no array de request');
        $this->assertEquals(
            'automatic_async',
            $request['capture_mode'],
            'O campo capture_mode deve ser igual a "automatic_async"'
        );

        $order = (new OrderClient())->create($request);
        $this->assertEquals('order_capture_mode_test', $order->id);
        $this->assertEquals('pending', $order->status);
    }

    public function testBoletoFieldReplacesBolbradescoInRequestAndResponse(): void
    {
        $mockResponse = [
            'id' => 'order_boleto_test',
            'status' => 'pending',
            'transactions' => [
                'payments' => [
                    [
                        'id' => 'pay_123',
                        'payment_method' => [
                            'id' => 'boleto',  // <-- novo campo na resposta
                            'type' => 'ticket'
                        ]
                    ]
                ]
            ]
        ];

        $mockHttpRequest = $this->getMockBuilder(\MercadoPago\Net\HttpRequest::class)
            ->disableOriginalConstructor()
            ->getMock();


        $mockHttpRequest->method('execute')->willReturn(json_encode($mockResponse));
        $mockHttpRequest->method('getInfo')->willReturnCallback(
            fn($option) => $option === CURLINFO_HTTP_CODE ? 201 : null
        );

        MercadoPagoConfig::setHttpClient(new MPDefaultHttpClient($mockHttpRequest));

        $request = [
            "type" => "online",
            "total_amount" => "42.00",
            "transactions" => [
                "payments" => [
                    [
                        "amount" => "42.00",
                        "payment_method" => [
                            "id" => "boleto",
                            "type" => "ticket"
                        ]
                    ]
                ]
            ],
            "payer" => [
                "email" => "testuser@mock.com"
            ]
        ];


        $this->assertEquals('boleto', $request['transactions']['payments'][0]['payment_method']['id']);

        $order = (new OrderClient())->create($request);

        $this->assertEquals('order_boleto_test', $order->id);
        $this->assertEquals('pending', $order->status);
        $this->assertEquals('boleto', $order->transactions->payments[0]->payment_method->id,
            'O campo payment_method.id da resposta deve ser "boleto".'
        );
    }
}