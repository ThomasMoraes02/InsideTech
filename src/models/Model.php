<?php 

namespace Src\models;

use PDO;

abstract class Model
{
    protected $db;

    protected function Connection()
    {
        // $db = new PDO(DB_DRIVER.': hosts='.DB_HOST.'; dbname='.DB_NAME, DB_USER, DB_PASS);
        // $db = new PDO("mysql:host=awsmysqlserver.cpmmtmvm6bii.us-east-2.rds.amazonaws.com;dbname=test_database_aws","admin","aws123456");
        return $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";",DB_USER, DB_PASS);
    }
}