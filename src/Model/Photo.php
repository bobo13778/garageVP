<?php

namespace App\Model;

class Photo extends Model
{
    protected int $id;
    protected string $src;
    protected int $vehiculeId;

    public function __construct()
    {
        $this->table = 'photos';
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function getVehiculeId(): int
    {
        return $this->vehiculeId;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setSrc(string $src): void
    {
        $this->src = $src;
    }

    public function setVehiculeId(int $vehiculeId): void
    {
        $this->vehiculeId = $vehiculeId;
    }

}
