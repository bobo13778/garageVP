<?php

namespace App\Model;

class Employe extends Model
{
    protected int $id;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected string $password;
    protected bool $moderator;
    protected string $poste;

    public function __construct()
    {
        $this->table = 'employes';
  
    }

    public function getRoles(): array
    {
        return ['ROLE_EMPLOYEE'];
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        
    }

    public function getTable(): string
    {
        return $this->table;
    }
    
    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getModerator(): bool
    {
        return $this->moderator;
    }

    public function getPoste(): string
    {
        return $this->poste;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setModerator(bool $moderator): void
    {
        $this->moderator = $moderator;
    }
    
    public function setPoste(string $poste): void
    {
        $this->poste = $poste;
    }

}