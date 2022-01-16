<?php

namespace Hahadu\PostmanApi;

use Hahadu\Helper\HttpHelper;
use Hahadu\PostmanApi\Contract\HttpContract;

class HttpRequest implements HttpContract
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

    public function get($uri,$id=null){
        if(null!=$id){
            $uri = $uri.$id;
        }
        return $this->request("get",$uri);
    }
    public function post($uri,$body){
        return $this->request("post",$uri,$body);
    }
    public function put($uri,$id,$body){
        if(null!=$id){
            $uri = $uri.$id;
        }
        return $this->request("put",$uri,$body);
    }
    public function delete($uri,$id){
        return $this->request("delete",$uri);
    }

    private function request($method,$uri,$body=null){
        $this->setHeader();
        if(null!==$body && is_array($body)){
            $body = json_encode($body);
        }
        $request = HttpHelper::request($method,$uri,$body,$this->headers);
        if(in_array($request->getResponseCode(),[200,400])){
            $result = $request->getBody()->toString();
            return json_decode($result,JSON_UNESCAPED_UNICODE);
        }else{
            echo "HTTP ERROR CODE:".$request->getResponseCode();
            return $request->getBody()->toString();
        }

    }


}
