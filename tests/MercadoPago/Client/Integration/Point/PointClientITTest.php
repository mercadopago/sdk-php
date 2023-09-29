<?php

namespace MercadoPago\Tests\Client\Integration\Point;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Point\PointClient;
use MercadoPago\Client\Point\PointDeviceOperatingModeRequest;
use MercadoPago\Client\Point\PointPaymentIntentListRequest;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;
use PHPUnit\Framework\TestCase;

/**
 * PointClient integration tests.
 */
final class PointClientITTest extends TestCase
{
    private const DEVICE_ID = "GERTEC_MP123__12345678";
    private const STORE_ID = "12345678";
    private const POS_ID = "12345678";

    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreatePaymentIntentSuccess(): void
    {
        $client = new PointClient();
        $request = $this->createRequest();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["x-test-scope: sandbox"]);
        try {
            $payment_intent = $client->createPaymentIntent(PointClientITTest::DEVICE_ID, $request, $request_options);
            $this->assertNotNull($payment_intent->id);
        } catch (MPApiException | \Exception $e) {
            $this->fail($e->getMessage());
        } finally {
            $client->cancelPaymentIntent(PointClientITTest::DEVICE_ID, $payment_intent->id, $request_options);
        }
    }

    public function testCreatePaymentIntentWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PointClient();
        $request = $this->createRequest();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->createPaymentIntent(PointClientITTest::DEVICE_ID, $request, $request_options);
    }

    public function testSearchPaymentIntentSuccess(): void
    {
        $client = new PointClient();
        $request = $this->createRequest();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["x-test-scope: sandbox"]);
        try {
            $payment_intent = $client->createPaymentIntent(PointClientITTest::DEVICE_ID, $request, $request_options);
            $payment_intent_search = $client->searchPaymentIntent($payment_intent->id, $request_options);
            $this->assertNotNull($payment_intent_search->id);
        } catch (MPApiException | \Exception $e) {
            $this->fail($e->getMessage());
        } finally {
            $client->cancelPaymentIntent(PointClientITTest::DEVICE_ID, $payment_intent->id, $request_options);
        }
    }

    public function testSearchPaymentIntentWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PointClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->searchPaymentIntent("123", $request_options);
    }

    public function testCancelPaymentIntentSuccess(): void
    {
        $client = new PointClient();
        $request = $this->createRequest();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["x-test-scope: sandbox"]);
        try {
            $payment_intent = $client->createPaymentIntent(PointClientITTest::DEVICE_ID, $request, $request_options);
            sleep(3);
            $payment_intent_cancel = $client->cancelPaymentIntent(PointClientITTest::DEVICE_ID, $payment_intent->id, $request_options);
            $this->assertNotNull($payment_intent_cancel->id);
        } catch (MPApiException | \Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCancelPaymentIntentWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PointClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->cancelPaymentIntent(PointClientITTest::DEVICE_ID, "123", $request_options);
    }

    public function testGetPaymentIntentListSuccess(): void
    {
        $client = new PointClient();
        $request = $this->createRequest();
        $list_request = $this->createPointPaymentIntentListRequest();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["x-test-scope: sandbox"]);
        try {
            $payment_intent = $client->createPaymentIntent(PointClientITTest::DEVICE_ID, $request, $request_options);
            sleep(3);
            $payment_intent_list = $client->getPaymentIntentList($list_request, $request_options);
            $this->assertNotNull($payment_intent_list->events[0]->payment_intent_id);
        } catch (MPApiException | \Exception $e) {
            $this->fail($e->getMessage());
        } finally {
            $client->cancelPaymentIntent(PointClientITTest::DEVICE_ID, $payment_intent->id, $request_options);
        }
    }

    public function testListPaymentIntentWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PointClient();
        $list_request = $this->createPointPaymentIntentListRequest();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->getPaymentIntentList($list_request, $request_options);
    }

    public function testGetPaymentIntentStatusSuccess(): void
    {
        $client = new PointClient();
        $request = $this->createRequest();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["x-test-scope: sandbox"]);
        try {
            $payment_intent = $client->createPaymentIntent(PointClientITTest::DEVICE_ID, $request, $request_options);
            sleep(3);
            $payment_intent_status = $client->getPaymentIntentStatus($payment_intent->id, $request_options);
            $this->assertNotNull($payment_intent_status->status);
            $this->assertNotNull($payment_intent_status->created_on);
        } catch (MPApiException | \Exception $e) {
            $this->fail($e->getMessage());
        } finally {
            $client->cancelPaymentIntent(PointClientITTest::DEVICE_ID, $payment_intent->id, $request_options);
        }
    }

    public function testGetPaymentIntentStatusWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PointClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->getPaymentIntentStatus("123", $request_options);
    }

    public function testGetDevicesSuccess(): void
    {
        $client = new PointClient();
        $request = $this->createRequest();
        $request = $this->createGetDevicesRequest();
        $devices = $client->getDevices($request);
        $this->assertNotNull($devices->devices[0]->id);
    }

    public function testGetDevicesWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PointClient();
        $request = $this->createGetDevicesRequest();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->getDevices($request, $request_options);
    }

    public function testChangeDeviceOperationgModeSuccess(): void
    {
        $client = new PointClient();
        $request = $this->createRequest();
        $request = $this->createGetDevicesRequest();
        $devices = $client->getDevices($request);
        $device_id = $devices->devices[0]->id;
        $request = $this->createOperatingModeRequest();
        $device_updated = $client->changeDeviceOperatingMode($device_id, $request);
        $this->assertSame("PDV", $device_updated->operating_mode);
    }

    public function testChangeDeviceOperationgModeWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PointClient();
        $request = $this->createOperatingModeRequest();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->changeDeviceOperatingMode("123", $request, $request_options);
    }

    private function createRequest(): array
    {
        $request = [
            "amount" => 100,
            "description" => "your payment intent description",
            "payment" => array(
                "installments" => 1,
                "type" => "credit_card",
                "installments_cost" => "seller"
            ),
            "additional_info" => array(
                "external_reference" => "4561ads-das4das4-das4754-das456",
                "print_on_terminal" => true
            )
        ];
        return $request;
    }

    private function createPointPaymentIntentListRequest(): PointPaymentIntentListRequest
    {
        $request = new PointPaymentIntentListRequest();
        $request->start_date = "2023-09-01";
        $request->end_date = "2023-09-30";
        return $request;
    }

    private function createGetDevicesRequest(): MPSearchRequest
    {
        $limit = 50;
        $offset = 0;
        $filters = array(
            "store_id" => PointClientITTest::STORE_ID,
            "pos_id" => PointClientITTest::POS_ID
        );
        $request = new MPSearchRequest($limit, $offset, $filters);
        return $request;
    }

    private function createOperatingModeRequest(): PointDeviceOperatingModeRequest
    {
        $request = new PointDeviceOperatingModeRequest();
        $request->operating_mode = "PDV";
        return $request;
    }
}
