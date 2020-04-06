<?php
namespace MercadoPago;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\Attribute; 

/**
 * @RestMethod(resource="/oauth/token", method="create")
 */

class OAuth extends Entity
{
   /**
     * @Attribute()
     */
    protected $client_secret;
    /**
     * @Attribute()
     */
    protected $grant_type;
    /**
     * @Attribute()
     */
    protected $code;
    /**
     * @Attribute()
     */
    protected $redirect_uri;

    /**
     * @Attribute()
     */
    protected $access_token;
    /**
     * @Attribute()
     */
    protected $public_key;
    /**
     * @Attribute()
     */
    protected $refresh_token;
    /**
     * @Attribute()
     */
    protected $live_mode;
    /**
     * @Attribute()
     */
    protected $user_id;
    /**
     * @Attribute()
     */
    protected $token_type;
    /**
     * @Attribute()
     */
    protected $expires_in;
    /**
     * @Attribute()
     */
    protected $scope;


    /**
     * @param $app_id
     * @param $redirect_uri
     * @return string
     */
    public function getAuthorizationURL($app_id, $redirect_uri){
        $county_id = strtolower(SDK::getCountryId());
        return "https://auth.mercadopago.com.${county_id}/authorization?client_id=${app_id}&response_type=code&platform_id=mp&redirect_uri=${redirect_uri}";
    }

    /**
     * @param $authorization_code
     * @param $redirect_uri
     * @return mixed
     * @throws \Exception
     */
    public function getOAuthCredentials($authorization_code, $redirect_uri){
      $this->client_secret = SDK::getAccessToken();
      $this->grant_type = 'authorization_code';
      $this->code = $authorization_code;
      $this->redirect_uri = $redirect_uri;

      return $this->save();
    }

    /**
     * @param $refresh_token
     * @return mixed
     * @throws \Exception
     */
    public function refreshOAuthCredentials($refresh_token){
      $this->client_secret = SDK::getAccessToken();
      $this->grant_type = 'refresh_token';
      $this->refresh_token = $refresh_token;

      return $this->save();
    }
}
