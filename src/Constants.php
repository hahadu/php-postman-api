<?php

namespace Hahadu\PostmanApi;

class Constants
{
    /** @var string HOST */
    const POSTMAN_APIS_URI_HOST = "https://api.getpostman.com/";
    /** @var string schema URI */
    const POSTMAN_API_SCHEMA_URI = "https://schema.getpostman.com/json/collection/v2.1.0/collection.json";
    /** @var string collections */
    const POSTMAN_APIS_COLLECTIONS_URI = self::POSTMAN_APIS_URI_HOST."collections".DIRECTORY_SEPARATOR;
    /** @var string environments */
    const POSTMAN_APIS_ENVIRONMENTS_URI = self::POSTMAN_APIS_URI_HOST."environments".DIRECTORY_SEPARATOR;
    /** @var string workspaces */
    const POSTMAN_APIS_WORKSPACES_URI = self::POSTMAN_APIS_URI_HOST."workspaces".DIRECTORY_SEPARATOR;
    /** @var string workspaces */
    const POSTMAN_APIS_MONITORS_URI = self::POSTMAN_APIS_URI_HOST."monitors".DIRECTORY_SEPARATOR;

    /** @var string 创建分支 */
    const POSTMAN_APIS_COLLECTIONS_FORK_URI = self::POSTMAN_APIS_COLLECTIONS_URI."fork".DIRECTORY_SEPARATOR;
    /** @var string 合并分支 */
    const POSTMAN_APIS_COLLECTIONS_MERGE_URI = self::POSTMAN_APIS_COLLECTIONS_URI."fork".DIRECTORY_SEPARATOR;


}
