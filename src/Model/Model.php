<?php

namespace App\Model;

use App\db\Db;

class model extends Db
{
  protected $table;
  private $db;

  public function request(string $sql, array $attributes = null)
  {
    $this->db = Db::getInstance();
    if($attributes !== null) {
      $query = $this->db->prepare($sql);
      $query->execute($attributes);
      return $query;
    } else {
      return $this->db->query($sql);
    }
  }

  //Methodes CRUD

  //Methodes READ
  //Pour lire toute une table
  public function findAll()
  {
    $query = $this->request("SELECT * FROM {$this->table}");
    return $query->fetchAll();
  }

  //Pour chercher des valeurs dans les tables
  public function findBy(array $params)
  {
    $keys = [];
    $values = [];

    foreach($params as $key => $value) {
      $keys[] = "$key = ?";
      $values[] = $value;
    }
    $list_keys = implode(' AND ', $keys);

    return $this->request("SELECT * FROM {$this->table} WHERE $list_keys", $values)->fetchAll();
    
  }
  //Pour chercher un enregistrement
  public function find(int $id)
  {
    return $this->request("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
  }

  //Methode CREATE : création d'un enregistrement
  public function create(Model $model)
  {
    $keys = [];
    $inter = [];
    $values = [];

    foreach($model as $key => $value){
      if($value !== null && $key != 'table' && $key != 'db'){
        $keys[] = $key;
        $inter[] = "?";
        $values[] = $value;
      }
    }
    $list_keys = implode(', ', $keys);
    $list_inters = implode(', ', $inter);

    return $this->request("INSERT INTO {$this->table} ({$list_keys}) VALUES ({$list_inters})", $values);
  }

  //Methode UPDATE : modification d'un enregistrement
  public function update(int $id, Model $model)
  {
    $keys = [];
    $values = [];

    foreach($model as $key => $value){
      if($value !== null && $key != 'table' && $key != 'db') {
        $keys[] ="$key = ?";
        $values[] = $value;
      }
    }

    $values[] = $id;

    $list_keys = implode(', ', $keys);

    return $this->request("UPDATE {$this->table} SET {$list_keys} WHERE id = ?", $values);
  }

  //Methode DELETE : supprimer un enregistrement
  public function delete(int $id){
    $values[] = $id;
    return $this->request("DELETE FROM {$this->table} WHERE id = ?", $values);
  }

  //Hydratation des données
  public function hydrate(array $datas)
  {
    foreach ($datas as $key => $value) {
      $method = 'set'.ucfirst($key);

      if (method_exists($this, $method)){
        $this->$method($value);
      }
    }
    return $this;
  }
}