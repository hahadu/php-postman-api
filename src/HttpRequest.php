<?php

namespace Hahadu\PostmanApi;

use Hahadu\Helper\HttpHelper;

class HttpRequest
{
    private $headers;

    private $apiKey;
    public function __construct($apiKey = null)
    {
        if($apiKey){
            $this->apiKey = $apiKey;
        }
    }
    public function setApiKey($apiKey){
        $this->apiKey = $apiKey;
        return $this;
    }
    private function setHeader(){
        $this->headers = [
            'X-Api-Key' => $this->apiKey,
            'Accept' => 'application/json',
            'Content-Type'=> 'application/json',
            'X-Requested-With' => "XMLHttpRequest",
        ];
    }

    public function get($uri,$body){
        return $this->request("get",$uri,$body);
    }
    public function post($uri,$body){
        return $this->request("post",$uri,$body);
    }
    public function put($uri,$body){
        return $this->request("put",$uri,$body);
    }
    public function delete($uri,$body){
        return $this->request("delete",$uri,$body);
    }

    private function request($method,$uri,$body=null){
        $this->setHeader();
        $request = HttpHelper::request($method,$uri,$body,$this->headers);
        if(in_array($request->getResponseCode(),[200,400])){
            $result = $request->getBody()->toString();
            return json_decode($result,JSON_UNESCAPED_UNICODE);
        }else{
            echo $request->getResponseCode();
            return $request->getBody()->toString();
        }

    }


}
