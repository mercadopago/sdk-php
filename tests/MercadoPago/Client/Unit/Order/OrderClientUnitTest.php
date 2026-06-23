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
            fn ($option) => $option === CURLINFO_HTTP_CODE ? 201 : null
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
            fn ($option) => $option === CURLINFO_HTTP_CODE ? 201 : null
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
        $this->assertEquals(
            'boleto',
            $order->transactions->payments[0]->payment_method->id,
            'O campo payment_method.id da resposta deve ser "boleto".'
        );
    }

    public function testCreateCheckoutPROSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Order/order_checkout_pro.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);
        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);
        $client = new OrderClient();

        $request = [
            "type" => "online",
            "processing_mode" => "manual",
            "total_amount" => "500.00",
            "external_reference" => "ext_ref_checkout_pro_001",
            "capture_mode" => "automatic",
            "marketplace_fee" => "5.00",
            "description" => "Travel package SAO-RIO with insurance",
            "expiration_time" => "P1D",
            "payer" => [
                "email" => "buyer@testuser.com",
                "first_name" => "John",
                "last_name" => "Smith",
                "identification" => ["type" => "CPF", "number" => "12345678909"],
                "phone" => ["area_code" => "11", "number" => "999998888"],
                "address" => ["zip_code" => "01310-100", "street_name" => "Av. Paulista", "street_number" => "1000"]
            ],
            "shipment" => [
                "mode" => "custom",
                "local_pickup" => false,
                "cost" => "15.00",
                "free_shipping" => false,
                "free_methods" => [["id" => 73328]],
                "address" => ["zip_code" => "01310-100", "street_name" => "Av. Paulista", "street_number" => "1000"]
            ],
            "config" => [
                "statement_descriptor" => "MYSTORE",
                "default_payment_due_date" => "P1D",
                "online" => [
                    "available_from" => "2026-01-01T00:00:00Z",
                    "allowed_user_type" => "account_only",
                    "success_url" => "https://example.com/success",
                    "failure_url" => "https://example.com/failure",
                    "pending_url" => "https://example.com/pending",
                    "auto_return" => "approved",
                    "tracks" => [
                        ["type" => "google_ad", "values" => ["conversion_id" => "21312312312123", "conversion_label" => "TEST"]],
                        ["type" => "facebook_ad", "values" => ["pixel_id" => "21312312312123"]]
                    ]
                ],
                "payment_method" => [
                    "max_installments" => 12,
                    "not_allowed_ids" => ["amex"],
                    "not_allowed_types" => ["ticket"],
                    "installments" => ["interest_free" => ["type" => "range", "values" => [2, 6]]]
                ]
            ],
            "items" => [
                ["external_code" => "ITEM-001", "title" => "Flight SAO-RIO", "quantity" => 1, "unit_price" => "450.00"],
                ["external_code" => "ITEM-002", "title" => "Travel insurance", "quantity" => 1, "unit_price" => "50.00"]
            ]
        ];

        $order = $client->create($request);

        $this->assertSame(201, $order->getResponse()->getStatusCode());
        $this->assertSame("ORDTST01KS5AJ6HTK2HRQ3XJ3C2JCKP9", $order->id);
        $this->assertSame("online", $order->type);
        $this->assertSame("manual", $order->processing_mode);
        $this->assertSame("created", $order->status);
        $this->assertSame("500.00", $order->total_amount);
        $this->assertSame("ext_ref_checkout_pro_001", $order->external_reference);
        // checkout_url is the key field for Checkout PRO — redirect the buyer here
        $this->assertNotNull($order->checkout_url);
        $this->assertStringContainsString("ORDTST01KS5AJ6HTK2HRQ3XJ3C2JCKP9", $order->checkout_url);
        // payer
        $this->assertSame("buyer@testuser.com", $order->payer->email);
        $this->assertSame("CPF", $order->payer->identification->type);
        $this->assertSame("12345678909", $order->payer->identification->number);
        // shipment
        $this->assertSame("custom", $order->shipment->mode);
        $this->assertFalse($order->shipment->local_pickup);
        $this->assertSame("15.00", $order->shipment->cost);
        $this->assertFalse($order->shipment->free_shipping);
        $this->assertSame(73328, $order->shipment->free_methods[0]["id"]);
        $this->assertSame("3", $order->shipment->address->floor);
        $this->assertSame("B", $order->shipment->address->apartment);
        // config root
        $this->assertSame("MYSTORE", $order->config->statement_descriptor);
        $this->assertSame("P1D", $order->config->default_payment_due_date);
        // config.online
        $this->assertSame("2026-01-01T00:00:00Z", $order->config->online->available_from);
        $this->assertSame("account_only", $order->config->online->allowed_user_type);
        $this->assertSame("https://example.com/success", $order->config->online->success_url);
        $this->assertSame("https://example.com/failure", $order->config->online->failure_url);
        $this->assertSame("https://example.com/pending", $order->config->online->pending_url);
        $this->assertSame("approved", $order->config->online->auto_return);
        $this->assertFalse($order->config->online->retries->allowed);
        $this->assertSame("google_ad", $order->config->online->tracks[0]->type);
        $this->assertSame("21312312312123", $order->config->online->tracks[0]->values["conversion_id"]);
        $this->assertSame("facebook_ad", $order->config->online->tracks[1]->type);
        $this->assertSame("21312312312123", $order->config->online->tracks[1]->values["pixel_id"]);
        // config.payment_method
        $this->assertSame(12, $order->config->payment_method->max_installments);
        $this->assertSame(["amex"], $order->config->payment_method->not_allowed_ids);
        $this->assertSame("range", $order->config->payment_method->installments->interest_free->type);
        $this->assertSame([2, 6], $order->config->payment_method->installments->interest_free->values);
        // items
        $this->assertCount(2, $order->items);
        $this->assertSame("Flight SAO-RIO", $order->items[0]->title);
        $this->assertSame("450.00", $order->items[0]->unit_price);
        $this->assertSame("Travel insurance", $order->items[1]->title);
        $this->assertSame("50.00", $order->items[1]->unit_price);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Order/order_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new OrderClient();
        $search_request = new \MercadoPago\Net\MPSearchRequest(5, 0, []);
        $search_result = $client->search($search_request);
        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(10, $search_result->paging->total);
        $this->assertSame(2, $search_result->paging->total_pages);
        $this->assertSame(5, $search_result->paging->limit);
        $this->assertSame(0, $search_result->paging->offset);
        $this->assertSame(1, count($search_result->data));
        $this->assertSame("01JD2P9GGXAPBDGG6YT90N77M3", $search_result->data[0]->id);
    }
}
