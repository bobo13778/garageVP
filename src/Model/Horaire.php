<?php

namespace App\Model;

class Horaire  extends Model
{
  protected int $id;
  protected string $day;
  protected string $morningStart;
  protected string $morningEnd;
  protected bool $morningIsClosed;
  protected string $afternoonStart;
  protected string $afternoonEnd;
  protected bool $afternoonIsClosed;

  public function __construct()
  {
      $this->table = 'horaires';

  }

  public function getTable(): string
  {
      return $this->table;
  }
  
  public function getId() : int {
    return $this->id;
  }

  public function getDay() : string {
    return $this->day;
  }

  public function getMorningStart() : string {
    return $this->morningStart;
  }

  public function getMorningEnd() : string {
    return $this->morningEnd;
  }

  public function getMorningIsClosed() : bool {
    return $this->morningIsClosed;
  }

  public function getAfternoonStart() : string {
    return $this->afternoonStart;
  }

  public function getAfternoonEnd() : string {
    return $this->afternoonEnd;
  }

  public function getAfternoonIsClosed() : bool {
    return $this->afternoonIsClosed;
  }

  public function setId(int $id) : void {
    $this->id = $id;
  }

  public function setDay(string $day) : void {
    $this->day = $day;
  }

  public function setMorningStart(string $morningStart) : void {
    $this->morningStart = $morningStart;
  }

  public function setMorningEnd(string $morningEnd) : void {
    $this->morningEnd = $morningEnd;
  }

  public function setMorningIsClosed(bool $morningIsClosed) : void {
    $this->morningIsClosed = $morningIsClosed;
  }

  public function setAfternoonStart(string $afternoonStart) : void {
    $this->afternoonStart = $afternoonStart;
  }

  public function setAfternoonEnd(string $afternoonEnd) : void {
    $this->afternoonEnd = $afternoonEnd;
  }

  public function setAfternoonIsClosed(bool $afternoonIsClosed) : void {
    $this->afternoonIsClosed = $afternoonIsClosed;
  }

}