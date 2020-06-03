<?php
namespace Alipay;
use Alipay\Request\SystemOauthToken;
use Alipay\Request\UserInfoShare;

class Client
{
    public $aop;

    public function __construct($config){

        $aop = new AopClient();
        $aop->gatewayUrl = $config['gateway'];
		$aop->appId = $config['appid'];
		$aop->rsaPrivateKey = $config['private'];
        $aop->alipayrsaPublicKey= $config['public'];
        
        $this->$aop = $aop;
    }
    
    public function getToken($code){
        $request = new SystemOauthToken();
		$request->setGrantType("authorization_code");
        $request->setCode($code);
        
        return $this->getResponse($request);
    }

    public function getUserInfoShare($accessToken){
        $request = new UserInfoShare();
        
        return $this->getResponse($request , $accessToken );
    }

    protected function getResponse($request, $authToken = null, $appInfoAuthtoken = null, $targetAppId = null){

        $response = $aop->execute ($request ,$authToken = null, $appInfoAuthtoken = null, $targetAppId = null); 
		$data = object2array($response);

        $key = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        
        return isset($data[$key]) ? $data[$key] : false;
    }
}