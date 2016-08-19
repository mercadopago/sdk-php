<?php

namespace MercadoPago;

/**
 * EntityTest Class Doc Comment
 *
 * @package MercadoPago
 */
class EntityTest
    extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    protected $config;
    protected $_entity;

    /**
     *
     */
    protected function setUp()
    {
        $restClient = new RestClient();
        $config = new Config(null, $restClient);

        $manager = new Manager($restClient, $config);
        Entity::setManager($manager);

        $this->_entity = new DummyEntity();
    }

    /**
     *
     */
    protected function tearDown()
    {
    }

    /**
     */
    public function testSetVariables()
    {
        $this->_entity->setTitle('Title');
        $this->_entity->setDesc('Description');
        $this->_entity->setPrice(100.5);
        $this->_entity->setQuantity(3);
        $this->_entity->setRegisteredAt('02/14/2015');
        $object = new \stdClass();
        $this->_entity->setObject($object);
        $this->_entity->setOther('other');

        $expectedValues = [
            "id"            => null,
            "title"         => "Title",
            "desc"          => "Description",
            "price"         => 100.5,
            "quantity"      => 3,
            "registered_at" => "2015-02-14T00:00:00+0000",
            "object"        => $object,
            "other"        => 'other'
        ];

        $this->assertEquals($expectedValues, $this->_entity->toArray());
    }

    /**
     */
    public function testGetVariables()
    {
        $this->_entity->setTitle(12);
        $this->_entity->setDesc('Description');
        $this->_entity->setPrice(100.5);
        $this->_entity->setQuantity("5x");
        $this->_entity->setRegisteredAt('02/14/2015');
        $object = new \stdClass();
        $this->_entity->setObject($object);
        $this->_entity->setOther('other');

        $expectedValues = [
            "id"            => null,
            "title"         => "12",
            "desc"          => "Description",
            "price"         => 100.5,
            "quantity"      => "5",
            "registered_at" => "2015-02-14T00:00:00+0000",
            "object"        => $object,
            "other"        => 'other'
        ];

        $actualValues = [
            "id"            => $this->_entity->getId(),
            "title"         => $this->_entity->getTitle(),
            "desc"          => $this->_entity->getDesc(),
            "price"         => $this->_entity->getPrice(),
            "quantity"      => $this->_entity->getQuantity(),
            "registered_at" => $this->_entity->getRegisteredAt(),
            "object"        => $this->_entity->getObject(),
            "other"        => $this->_entity->getOther(),
        ];

        $this->assertEquals($expectedValues, $actualValues);
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Invalid method MercadoPago\DummyEntity::invalidMethod
     */
    public function testInvalidMethod()
    {
        $this->_entity->invalidMethod();

    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Wrong type object. It should be int for property quantity
     */
    public function testInvalidType()
    {
        $this->_entity->setQuantity(new \stdClass());
    }

    /**
     */
    public function testLoadAll()
    {
        $hub = new FakeApiHub();
        $request = $this->getMockBuilder('MercadoPago\Http\CurlRequest')->getMock();
        $request->expects($this->once())
            ->method('execute')
            ->will($this->returnValue($hub->getJson('GET', '/dummies')));
        $request->expects($this->once())
            ->method('getInfo')->withAnyParameters()
            ->will($this->returnValue('200'));

        $restClient = new RestClient();
        $restClient->setHttpRequest($request);
        $config = new Config(null, $restClient);

        $manager = new Manager($restClient, $config);
        Entity::setManager($manager);

        $this->_entity = new DummyEntity();

        $this->assertEquals((array)json_decode($hub->getJson('GET', '/dummies')), $this->_entity->loadAll()['body']);

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