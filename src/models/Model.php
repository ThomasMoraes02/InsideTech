<?php 

namespace Src\models;

use PDO;

abstract class Model
{
    protected $db;

    protected function Connection()
    {
        return $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";",DB_USER, DB_PASS);
    }
}