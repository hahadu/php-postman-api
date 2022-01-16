<?php

namespace Hahadu\PostmanApi\Contract;
use Hahadu\Collect\Collection;

interface FunctionsContract
{
    public function getList():Collection;
    /**
     * 根据标题查询
     * @param $name
     * @return Collection
     */
    public function getByName($name):Collection;

    /**
     * 根据ID查询
     * @param int|null $id ID or UID
     * @return Collection
     */
    public function getById(int $id=null):Collection;

    /**
     * 创建
     * @param $body
     * @return array
     */
    public function create($body):array;

    /**
     * 修改
     * @param $id
     * @param $body
     * @return array
     */
    public function update($id,$body):array;

    /**
     * 删除
     * @param $id
     * @return array
     */
    public function delete($id):array;

}
