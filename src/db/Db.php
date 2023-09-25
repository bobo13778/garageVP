<?php

nameSpace App\db;

use PDO;
use PDOException;

class Db extends PDO
{
  private static $instance;
  private const DBHOST = 'ec2-18-205-44-21.compute-1.amazonaws.com';
  private const DBUSER = 'wznxnggnfgjycx';
  private const DBPASS = '719459fe0bdeb2234e1e577c8d1ef8bb2185cee57993764919785db8ae067c71';
  private const DBNAME = 'd8nt1ild55488q';

  private function __construct()
  {
    $dsn ='mysql:dbname='.self::DBNAME.';host='.self::DBHOST;

    try{
      parent::__construct($dsn, self::DBUSER, self::DBPASS);
      $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
      $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public static function getInstance():self
  {
    if(self::$instance === null){
      self::$instance = new self();
    }
    return self::$instance;
  }
}