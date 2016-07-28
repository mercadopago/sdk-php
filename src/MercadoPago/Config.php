<?php
namespace MercadoPago;

use Exception;
use MercadoPago\Config\Json;
use MercadoPago\Config\Yaml;

/**
 * Config Class Doc Comment
 *
 * @package MercadoPago
 */
class Config
    extends Config\AbstractConfig
{
    /**
     * Available parsers
     * @var array
     */
    private $_supportedFileParsers = [
        'MercadoPago\\Config\\Json',
        'MercadoPago\\Config\\Yaml',
    ];

    /**
     * Default values
     * @return array
     */
    protected function getDefaults()
    {
        return ['base_url'      => 'https://api.mercadopago.com',
                'CLIENT_ID'     => '',
                'CLIENT_SECRET' => '',
                'APP_ID'        => '',
                'ACCESS_TOKEN'  => '',
                'REFRESH_TOKEN' => '',
                'sandbox_mode'  => true,
        ];
    }

    /**
     * @param null $path
     *
     * Static load method
     * @return static
     */
    public static function load($path = null)
    {
        return new static($path);
    }

    /**
     * Config constructor.
     *
     * @param null $path
     */
    public function __construct($path = null)
    {
        $this->data = [];
        if (is_file($path)) {
            $info = pathinfo($path);
            $parts = explode('.', $info['basename']);
            $extension = array_pop($parts);
            $parser = $this->_getParser($extension);
            $this->data = array_replace_recursive($this->data, (array)$parser->parse($path));
        }
        parent::__construct($this->data);
    }

    /**
     * @param $extension
     *
     * Get Parser depending on extension
     * @return null
     * @throws Exception
     */
    private function _getParser($extension)
    {
        $parser = null;
        foreach ($this->_supportedFileParsers as $fileParser) {
            $tempParser = new  $fileParser;
            if (in_array($extension, $tempParser->getSupportedExtensions($extension))) {
                $parser = $tempParser;
                continue;
            }
        }
        if ($parser === null) {
            throw new Exception('Unsupported configuration format');
        }

        return $parser;
    }

    /**
     * Set config value
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        parent::set($key, $value);
        if ($this->get('CLIENT_ID') != "" && $this->get('CLIENT_SECRET') != "") {
            $response = $this->getToken();
            if (isset($response['access_token']) && isset($response['refresh_token'])) {
                parent::set('ACCESS_TOKEN', $response['access_token']);
                parent::set('REFRESH_TOKEN', $response['refresh_token']);
            }
        }
    }

    /**
     * Obtain token with key and secret
     * @return mixed
     */
    public function getToken()
    {
        $restClient = new RestClient();
        $data = ['grant_type'    => 'client_credentials',
                 'client_id'     => $this->get('CLIENT_ID'),
                 'client_secret' => $this->get('CLIENT_SECRET')];
        $restClient->setHttpParam('address', $this->get('base_url'));
        $restClient->setHttpParam('use_ssl', true);
        $response = $restClient->post("/oauth/token", ['json_data' => json_encode($data)]);
        return $response['body'];
    }

}