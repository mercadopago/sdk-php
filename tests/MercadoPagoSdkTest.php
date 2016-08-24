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
     *
     */
    protected function setUp()
    {
        Entity::unSetManager();
    }

    /**
     *
     */
    protected function tearDown()
    {
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Please initialize SDK first
     */
    public function testWrongInitialization()
    {
        $entity = new DummyEntity();
    }

    /**
     */
    public function testInitialization()
    {
        MercadoPagoSdk::initialize();
        $entity = new DummyEntity();
        $this->assertInstanceOf(DummyEntity::class, $entity);
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