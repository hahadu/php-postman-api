<?php

namespace Hahadu\PostmanApi;
use Hahadu\Helper\HttpHelper;
use function collect;

/**
 * guzzle 上传限制长度，用php-http
 */
class Postman
{

    private $headers;
    public function __construct($apiKey)
    {
        $this->headers = [
            'X-Api-Key' => $apiKey,
            'Accept' => 'application/json',
            'Content-Type'=> 'application/json',
            'X-Requested-With' => "XMLHttpRequest",
        ];

    }

    /**
     * 获取全部
     * @return \Hahadu\Collect\Collection|\Illuminate\Support\Collection
     */
    public function getList(){
        $result = $this->request('get',Constants::POSTMAN_APIS_COLLECTIONS_URI);

        return collect($result['collections']);
    }

    public function getDetailBuName($collection_name){
        $list = $this->getList();
        $detail = $list->where('name',$collection_name);

        if(!$detail->isEmpty()){
            $detail = $detail->first();
            return $this->getDetailByUid($detail['uid']);
        }
    }

    public function getDetailByUid($collection_uid){
        $result = $this->request('get',Constants::POSTMAN_APIS_COLLECTIONS_URI.$collection_uid);

        return $result;
    }

    public function createCollection($collection_data){

        return $this->request('POST',Constants::POSTMAN_APIS_COLLECTIONS_URI,$collection_data);
    }
    public function updateCollection($collection_uid,$collection_data){

        return $this->request('PUT',Constants::POSTMAN_APIS_COLLECTIONS_URI.$collection_uid,$collection_data);
    }
    public function deleteCollection($collection_uid){

        return $this->request('DELETE',Constants::POSTMAN_APIS_COLLECTIONS_URI.$collection_uid);
    }

    private function request($method,$uri,$body=null,$options=[]){

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
