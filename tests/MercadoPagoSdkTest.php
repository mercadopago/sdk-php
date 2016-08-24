<?php

namespace MercadoPago;

/**
 * EntityTest Class Doc Comment
 *
 * @package MercadoPago
 */
class MercadopagoSdkTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    protected $_config;
    protected $_entity;
    protected $_manager;

    /**
     *
     */
    protected function setUp()
    {
    }

    /**
     *
     */
    protected function tearDown()
    {
    }

    /**
     */
    public function testInitialization()
    {
        MercadoPagoSdk::initialize();
        $this->_entity = new DummyEntity();
        $this->assertInstanceOf(DummyEntity::class, $this->_entity);
    }
    
    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Please initialize SDK first
     */
    public function testWrongInitialization()
    {
        $this->_entity = new DummyEntity();
    }


    /**
     */
    public function testLoad()
    {

    }

    /**
     */
    public function testAddNew()
    {

    }

    /**
     */
    public function testUpdate()
    {

    }

    /**
     */
    public function testDestroy()
    {

    }

    /**
     */
    public function save()
    {

    }

}