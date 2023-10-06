<?php

nameSpace App\db;

use PDO;
use PDOException;

class Db extends PDO
{
  private static $instance;
  private const DBHOST = 'ec2-3-212-29-93.compute-1.amazonaws.com';
  private const DBUSER = 'hsagzmcpioofrn';
  private const DBPASS = '1caccba27394ffcf43777bd95e1e38b7601ac9ff8276a3576965bf522d6dbeae';
  private const DBNAME = 'd7h5ukqlddc08l';
  private const DBPORT = '5432';

  private function __construct()
  {
    $dsn ='pgsql:host='.self::DBHOST.';port='.self::DBPORT.';dbname='.self::DBNAME.';user='.self::DBUSER.';password='.self::DBPASS;

    try{
      parent::__construct($dsn);
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