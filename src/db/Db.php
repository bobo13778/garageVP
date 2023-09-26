<?php

nameSpace App\db;

use PDO;
use PDOException;

class Db extends PDO
{
  private static $instance;
  private const DBHOST = 'ec2-3-210-173-88.compute-1.amazonaws.com';
  private const DBUSER = 'fjxyfnxdzmuwdj';
  private const DBPASS = '26f090c710ed7ed89a400c8433ba8d2272edf04902e834f19ba9c7bf54514dab';
  private const DBNAME = 'dbdaoklro3jdmt';

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