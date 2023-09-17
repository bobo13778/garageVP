<?php

namespace App\Model;

class Service  extends Model
{
  protected int $id;
  protected string $name;
  protected string $description;
  protected string $picture;

  public function __construct()
  {
      $this->table = 'services';

  }

  public function getTable(): string
  {
      return $this->table;
  }
  
  public function getId() : int {
    return $this->id;
  }

  public function getName() : string {
    return $this->name;
  }

  public function getDescription() : string {
    return $this->description;
  }
  
  public function getPicture() : string {
    return $this->picture;
  }


  public function setId(int $id) : void {
    $this->id = $id;
  }

  public function setName(string $name) : void {
    $this->name = $name;
  }

  public function setDescription(string $description) : void {
    $this->description = $description;
  }

  public function setPicture(string $picture) : void {
    $this->picture = $picture;
  }

}