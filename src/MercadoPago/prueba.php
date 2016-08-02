<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
require_once "../../vendor/autoload.php";
$conn = new \MercadoPago\Driver();
//$conn = new \MercadoPago\Connection($params, , $routings);
$isDevMode = true;

$paths = array(__DIR__ . '/Entities');
$driver = new AnnotationDriver(new AnnotationReader(), $paths);
$config = Setup::createConfiguration($isDevMode);
AnnotationRegistry::registerLoader('class_exists');
$config->setMetadataDriverImpl($driver);
//$config->newDefaultAnnotationDriver([], false);
$entityManager = EntityManager::create($conn->connect([]), $config);
$entityManager->getRepository('MercadoPago\Entities\PaymentMethod')->findAll();