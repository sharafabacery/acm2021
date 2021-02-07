<?php

require '../vendor/autoload.php';
class Config{

public $app_id;
public $key ;
public $secret ;
public $cluster ;

function __construct() {
    
    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
    $dotenv->load();
    
    $this->app_id=$_ENV['app_id'];
    $this->key=$_ENV['key'];
    $this->secret=$_ENV['secret'];
    $this->cluster=$_ENV['cluster'];
}

}


?>