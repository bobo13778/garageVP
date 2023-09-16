<?php

namespace App\Model;

class Poste extends Model
{
    protected int $id;
    protected string $name;


    public function __construct()
    {
        $this->table = 'postes';

    }

    public function getTable(): string
    {
        return $this->table;
    }
    
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

}