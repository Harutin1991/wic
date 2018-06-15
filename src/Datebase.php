<?php
namespace App;
use \PDO;
use App\Config;
class Datebase extends PDO{
    
    public function __construct() {
        parent::__construct(Config::DB_TYPE.":host=".Config::DB_HOST.";dbname=".Config::DB_NAME,Config::DB_USER,Config::DB_PASSWORD);
    }
}
