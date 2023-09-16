<?php

namespace App\Model;

class Fuel  extends Model
{
  protected int $id;
  protected string $type;

  public function __construct()
  {
      $this->table = 'fuels';
  }

  public function getTable(): string
  {
      return $this->table;
  }
  
  public function getId() : int {
    return $this->id;
  }

  public function getType() : string {
    return $this->type;
  }

  public function setId(int $id) : void {
    $this->id = $id;
  }

  public function setType(string $type) : void {
    $this->type = $type;
  }

}