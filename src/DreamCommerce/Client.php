<?php
namespace DreamCommerce;


use DreamCommerce\Exception\ClientException;
use DreamCommerce\Exception\HttpException;

/**
 * DreamCommerce requesting library
 * @package DreamCommerce
 */
class Client {

    /**
     * API entrypoint
     * @var null|string
     */
    protected $entrypoint = null;

    /**
     * OAuth ID
     * @var null|string
     */
    protected $clientId = null;
    /**
     * OAuth secret
     * @var null|string
     */
    protected $clientSecret = null;

    /**
     * HTTP Client handle
     * @var Http|null
     */
    protected $client = null;

    /**
     * access token
     * @var string
     */
    protected $accessToken = null;

    /**
     * @param string $entrypoint shop url
     * @param string $clientId
     * @param string $clientSecret
     * @throws Exception\ClientException
     */
    public function __construct($entrypoint, $clientId, $clientSecret){
        if(!filter_var($entrypoint, FILTER_VALIDATE_URL)){
            throw new ClientException('', ClientException::ENTRYPOINT_URL_INVALID);
        }

        $this->client = Http::instance();

        // adjust base URL
        if($entrypoint[strlen($entrypoint)-1]=='/'){
            $entrypoint = substr($entrypoint, 0, -1);
        }

        // adjust webapi query
        if(strpos($entrypoint, '/webapi/rest')===false){
            $entrypoint .= '/webapi/rest';
        }

        $this->entrypoint = $entrypoint;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * get OAuth tokens
     * @param string $authCode
     * @return array
     * @throws Exception\ClientException
     */
    public function getToken($authCode){

        $res = $this->client->post($this->entrypoint.'/oauth/token', array(
            'code'=>$authCode
        ), array(
            'grant_type'=>'authorization_code'
        ), array(
            'Authorization'=>'Basic '.base64_encode($this->clientId.':'.$this->clientSecret)
        ));

        if(!$res || isset($res['data']->error)){
            throw new ClientException($res['data']->error, ClientException::API_ERROR);
        }

        // automatically set token to the freshly requested
        $this->setAccessToken($res['data']->access_token);

        return $res['data'];
    }

    /**
     * refresh OAuth tokens
     * @param string $refreshToken
     * @return array
     * @throws Exception\ClientException
     */
    public function refreshToken($refreshToken){

        $res = $this->client->post($this->entrypoint.'/oauth/token', array(
            'client_id'=>$this->clientId,
            'client_secret'=>$this->clientSecret,
            'refresh_token'=>$refreshToken
        ), array(
            'grant_type'=>'refresh_token'
        ));

        if(!$res || !empty($res['data']['error'])){
            throw new ClientException($res['error'], ClientException::API_ERROR);
        }

        $this->setAccessToken($res['data']['access_token']);

        return $res['data'];
    }

    /**
     * sets an access token for further requests
     * @param $token
     */
    public function setAccessToken($token){
        $this->accessToken = $token;
    }

    /**
     * performs REST request
     * @param $res
     * @param string $method
     * @param null|array|int $object
     * @param array $data
     * @param array $query
     * @throws ClientException
     * @return array
     */
    public function request(Resource $res, $method, $object = null, $data = array(), $query = array()){
        if(!method_exists($this->client, $method)){
            throw new ClientException('', ClientException::METHOD_NOT_SUPPORTED);
        }

        $url = $this->entrypoint.'/'.$res->getName();
        if($object){
            if(is_array($object)){
                $object = join('/', $object);
            }
            $url .= '/'.$object;
        }

        // setup OAuth token and we request JSON
        $headers = array(
            'Authorization'=>'Bearer '.$this->accessToken,
            'Content-Type'=>'application/json'
        );

        try{

            // dispatch correct method
            if(in_array($method, array('get', 'delete'))){
                return call_user_func(array(
                    $this->client, $method
                ), $url, $query, $headers);
            }else{
                return call_user_func(array(
                    $this->client, $method
                ), $url, $data, $query, $headers);
            }

        }catch(HttpException $ex){
            throw new ClientException('HTTP error: '.$ex->getMessage(), ClientException::API_ERROR, $ex);
        }
    }

    /**
     * automagic instantiator, alternative:
     * $resource = new \DreamCommerce\Resource(Client $client, 'name')
     *
     * @return Resource
     * @param $resource
     */
    public function __get($resource){
        return new Resource($this, $resource);
    }

    /**
     * allows exception error message extraction
     * @param \Exception $ex
     * @return mixed
     */
    static public function getError(\Exception $ex){

        $exception = $ex;
        while($r = $exception->getPrevious()){
            if($r){
                $exception = $r;
            }
        };

        if($exception instanceof HttpException){
            $response = $exception->getResponse();
            if($response instanceof \stdClass){
                return $response->error.' - '.$response->error_description;
            }else{
                $headers = $exception->getHeaders();
                return $headers[0];
            }
        }

        return $exception->getMessage();
    }

}