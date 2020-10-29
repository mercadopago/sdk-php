<?php 

use PHPUnit\Framework\TestCase;

/**
 * EntityTest Class Doc Comment
 *
 * @package MercadoPago
 */
class InstoreTest extends TestCase
{

    public static function setUpBeforeClass()
    {
        MercadoPago\SDK::cleanCredentials();
        
        if (file_exists(__DIR__ . '/../../.env')) {
            $dotenv = new Dotenv\Dotenv(__DIR__, '../../.env');
            $dotenv->load();
        }

        MercadoPago\SDK::setAccessToken(getenv('ACCESS_TOKEN'));
    }

    public function testCreatePos() {
        $pos = new MercadoPago\POS();
        $pos->name = "mypointofsale";
        $pos->fixed_amount =true; 
        $pos->external_id = "mypos" . rand(1, 10000);

        $pos->save();
        $this->assertEquals($pos->status, 'active');
        return $pos;
    }

    /**
     * @depends testCreatePos
     */
    public function testUpdatePos(MercadoPago\POS $created_pos) {
        $created_pos->name = "mypointofsalenewname";
        $created_pos->update();

        $pos = MercadoPago\POS::find_by_id($created_pos->id);

        $this->assertEquals($pos->name, 'mypointofsalenewname');
        
    }

    /**
     * @depends testCreatePos 
     */
    public function testSearchPos(MercadoPago\POS $pos) {
        $filters = array(
            "external_id" => $pos->external_id
        );
        $poss = MercadoPago\POS::search($filters);
        $poss = $poss->getArrayCopy();
        $poss = end($poss);

        $this->assertEquals($poss->external_id, $pos->external_id);
    }

    

    // public function testDeletePos(MercadoPago\POS $pos) {
    //     $pos = new MercadoPago\POS();

    // }

}

?>