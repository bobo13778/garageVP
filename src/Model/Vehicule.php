<?php

namespace App\Model;

class Vehicule extends Model
{
  protected int $id;
  protected string $title;
  protected string $description;
  protected float $price;
  protected int $mainPictureId;
  protected int $year;
  protected int $mileage;
  protected string $gearbox;
  protected string $color;
  protected int $doors;
  protected int $seats;
  protected float $width;
  protected float $height;
  protected float $length;
  protected int $trunkVolume;
  protected int $power;
  protected int $fiscalPower;
  protected int $co2Emission;
  protected string $fuel;

  public function __construct()
  {
      $this->table = 'vehicules';

  }

  public function getTable(): string
  {
      return $this->table;
  }
  
  public function getId() : int {
    return $this->id;
  }

  public function getTitle() : string {
    return $this->title;
  }

  public function getDescription() : string {
    return $this->description;
  }

  public function getPrice() : float {
    return $this->price;
  }

  public function getMainPictureId() : int {
    return $this->mainPictureId;
  }

  public function getYear() : int {
    return $this->year;
  }

  public function getMileage() : int {
    return $this->mileage;
  }

  public function getGearbox() : string {
    return $this->gearbox;
  }

  public function getColor() : string {
    return $this->color;
  }

  public function getDoors() : int {
    return $this->doors;
  }

  public function getSeats() : int {
    return $this->seats;
  }

  public function getWidth() : float {
    return $this->width;
  }

  public function getHeight() : float {
    return $this->height;
  }

  public function getLength() : float {
    return $this->length;
  }

  public function getTrunkVolume() : int {
    return $this->trunkVolume;
  }

  public function getPower() : int {
    return $this->power;
  }

  public function getFiscalPower() : int {
    return $this->fiscalPower;
  }

  public function getCo2Emission() : int {
    return $this->co2Emission;
  }

  public function getFuel() : string {
    return $this->fuelId;
  }

  public function setId(int $id) : void {
    $this->id = $id;
  }

  public function setTitle(string $title) : void {
    $this->title = $title;
  }

  public function setDescription(string $description) : void {
    $this->description = $description;
  }

  public function setPrice(float $price) : void {
    $this->price = $price;
  }

  public function setMainPictureId(int $mainPictureId) : void {
    $this->mainPictureId = $mainPictureId;
  }

  public function setYear(int $year) : void {
    $this->year = $year;
  }

  public function setMileage(int $mileage) : void {
    $this->mileage = $mileage;
  }

  public function setGearbox(string $gearbox) : void {
    $this->gearbox = $gearbox;
  }

  public function setColor(string $color) : void {
    $this->color = $color;
  }

  public function setDoors(int $doors) : void {
    $this->doors = $doors;
  }

  public function setSeats(int $seats) : void {
    $this->seats = $seats;
  }

  public function setWidth(float $width) : void {
    $this->width = $width;
  }

  public function setHeight(float $height) : void {
    $this->height = $height;
  }

  public function setLength(float $length) : void {
    $this->length = $length;
  }

  public function setTrunkVolume(int $trunkVolume) : void {
    $this->trunkVolume = $trunkVolume;
  }

  public function setPower(int $power) : void {
    $this->power = $power;
  }

  public function setFiscalPower(int $fiscalPower) : void {
    $this->fiscalPower = $fiscalPower;
  }

  public function setCo2Emission(int $co2Emission) : void {
    $this->co2Emission = $co2Emission;
  }

  public function setFuel(string $fuel) : void {
    $this->fuel = $fuel;
  }


}