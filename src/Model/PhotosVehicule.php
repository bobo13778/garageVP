<?php

namespace App\Model;

class PhotosVehicule  extends Model
{
  protected int $photoId;
  protected int $vehiculeId;

  public function __construct()
  {
      $this->table = 'photosvehicules';
  }

  public function getTable(): string
  {
      return $this->table;
  }
  
  public function getPhotoId() : int {
    return $this->photoId;
  }

  public function getVehiculeId() : int {
    return $this->vehiculeId;
  }

  public function setPhotoId(int $photoId) : void {
    $this->photoId = $photoId;
  }

  public function setVehiculeId(string $vehiculeId) : void {
    $this->vehiculeId = $vehiculeId;
  }

}