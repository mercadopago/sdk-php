<?php

namespace MercadoPago;

class RestClientTestextends extends \PHPUnit\Framework\TestCase
{
    protected $config;

    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    /**
     * @covers                   \MercadoPago\RestClient::__construct
     * @covers                   \MercadoPago\RestClient::setHttpRequest
     * @covers                   \MercadoPago\RestClient::getHttpRequest
     * @covers                   \MercadoPago\RestClient::exec
     * @covers                   \MercadoPago\RestClient::get
     * @covers                   \MercadoPago\RestClient::getArrayValue
     * @covers                   \MercadoPago\RestClient::setHeaders
     * @covers                   \MercadoPago\Http\CurlRequest::__construct
     */
    public function testDoGetTokenRequest()
    {
        $hub = new FakeApiHub();

        $request = $this->getMockBuilder('MercadoPago\Http\CurlRequest')->getMock();
        $request->expects($this->once())
            ->method('execute')
            ->will($this->returnValue($hub->getJson('GET', '/oauth/token')));
        $request->expects($this->once())
            ->method('getInfo')->withAnyParameters()
            ->will($this->returnValue('200'));
        $restClient = new RestClient();
        $restClient->setHttpRequest($request);
        $response = $restClient->get("/dummy_get");
        
        $this->assertEquals('APP_USR-6295877106812064-042916-5ab7e29152843f61b4c218a551227728__LC_LB__-202809963', $response['body']['access_token']);
        $this->assertEquals('200', $response['code']);
    }

    /**
     * @covers                   RestClient::post()
     * @covers                   RestClient::exec()
     */
    public function testDoPostRequest()
    {
        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        //RestClient::post("/dummy_post", ['json_data' => 'hello world']);
    }

    /**
     * @covers                   RestClient::put()
     * @covers                   RestClient::exec()
     */
    public function testDoPutRequest()
    {
        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        //RestClient::put("/dummy_put", ['json_data' => 'hello world']);
    }

    /**
     * @covers                   RestClient::delete()
     * @covers                   RestClient::exec()
     */
    public function testDoDeleteRequest()
    {
        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        //RestClient::delete("/dummy_delete", ['id' => '15']);
    }

    /**
     * @covers                   RestClient::exec()
     */
    public function testDoCustomHeadersRequest()
    {
        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers                   RestClient::exec()
     */
    public function testDoFailedRequest()
    {
        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers                   RestClient::exec()
     */
    public function testDoForbbidenRequest()
    {
        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers                   RestClient::exec()
     */
    public function testDoNotFoundRequest()
    {
        // Stop here and mark this test as incomplete.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }


}