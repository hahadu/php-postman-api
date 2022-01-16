<?php

namespace Hahadu\PostmanApi\Functions;

use Hahadu\Collect\Collection;
use Hahadu\PostmanApi\Constants;
use Hahadu\PostmanApi\Contract\FunctionsContract;
use Hahadu\PostmanApi\HttpRequest;

class Monitors implements FunctionsContract
{
    protected $request;

    public function __construct($apiKey)
    {
        $this->request = new HttpRequest($apiKey);
    }

    /**
     * @return Collection
     */
    public function getList(): Collection
    {
        $result = $this->request->get(Constants::POSTMAN_APIS_MONITORS_URI);


        return new Collection($result['collections']);
    }

    /**
     * @param $name
     * @return Collection|null
     */
    public function getByName($name): Collection
    {
        $list = $this->getList();
        $detail = $list->where('name',$name);

        if(!$detail->isEmpty()){
            $detail = $detail->first();
            return $this->getById($detail['uid']);
        }else{
            return new Collection();
        }
    }

    /**
     * @param $id
     * @return Collection
     */
    public function getById($id = null): Collection
    {
        $response = $this->request->get(Constants::POSTMAN_APIS_MONITORS_URI.$id);
        $result = new Collection($response['collection']['item']);
        $result->info = $response['collection']['info'];
        $result->collection = $result;

        return $result;
    }

    /**
     * @param array|string $body
     * @return array
     */
    public function create($body): array
    {
        return $this->request->post(Constants::POSTMAN_APIS_MONITORS_URI,$body);
    }

    /**
     * @param $id
     * @param $body
     * @return array
     */
    public function update($id, $body): array
    {
        return $this->request->put(Constants::POSTMAN_APIS_MONITORS_URI,$id,$body);
    }

    /**
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        return $this->request->delete(Constants::POSTMAN_APIS_MONITORS_URI,$id);
    }
}
