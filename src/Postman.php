<?php

namespace Hahadu\PostmanApi;
use Hahadu\Helper\HttpHelper;
use Hahadu\PostmanApi\Functions\Collections;
use Hahadu\PostmanApi\Functions\Workspaces;
use function collect;

/**
 * guzzle 上传限制长度，用php-http
 */
class Postman
{
    /**
     * @var HttpRequest
     */
    protected $request;
    /**
     * apiKey
     * @var string
     */
    private $apiKey;
    public function __construct($apiKey=null)
    {
        $this->apiKey = $apiKey;
        $this->request = new HttpRequest($apiKey);
    }

    public function collections():Collections
    {
        return new Collections($this->apiKey);
    }

    public function workspaces()
    {
        return new Workspaces($this->apiKey);

    }



}
