<?php

namespace Hahadu\PostmanApi\Contract;

interface HttpContract
{

    public function get($uri,$id=null);
    public function post($uri,$body);
    public function put($uri,$id,$body);
    public function delete($uri,$id);

}
