<?php 
/**
 * EntityTest Class Doc Comment
 *
 * @package MercadoPago
 */
class PreferenceTest extends \PHPUnit\Framework\TestCase
{

    private $last_preference = null;

    protected function setUp()
    {
        MercadoPago\SDK::setClientId($_ENV['CLIENT_ID']);
        MercadoPago\SDK::setClientSecret($_ENV['CLIENT_SECRET']);
    }

    public function testCreatePrefence()
    {
        $preference = new MercadoPago\Preference();

        # Building an item
        $item = new MercadoPago\Item();
        $item->id = "00001";
        $item->title = "item"; 
        $item->quantity = 1;
        $item->unit_price = 100;

        $preference->items = array($item);

        $preference->save();

        $last_preference = $preference;

        $this->assertTrue($preference->sandbox_init_point != null);
    }

    public function testFindPreferenceById(){
        $preference = MercadoPago\Preference::find_by_id($this->$last_preference->id);
        $this->assertEquals($preference->id, $this->$last_preference->id);
    }
}
?>