<?php

namespace App\Model;

class Temoignage  extends Model
{
  protected int $id;
  protected string $name;
  protected string $content;
  protected int $grade;
  protected bool $toValidate;

  public function __construct()
  {
      $this->table = 'temoignages';

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

  public function getContent() : string {
    return $this->content;
  }

  public function getGrade() : int {
    return $this->grade;
  }

  public function getTovalidate() : bool {
    return $this->toValidate;
  }

  public function setId(int $id) : void {
    $this->id = $id;
  }

  public function setName(string $name) : void {
    $this->name = $name;
  }

  public function setContent(string $content) : void {
    $this->content = $content;
  }

  public function setGrade(int $grade) : void {
    $this->grade = $grade;
  }

  public function setToValidate(int $toValidate) : void {
    $this->toValidate = $toValidate;
  }


}