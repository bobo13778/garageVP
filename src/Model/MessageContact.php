<?php

namespace App\Model;

class MessageContact extends Model
{
    protected int $id;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected string $phoneNumber;
    protected string $message;

    public function __construct()
    {
        $this->table = 'contacts';

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

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getMessage(): int
    {
        return $this->message;
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

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }
    
    public function setMessage(int $message): void
    {
        $this->message = $message;
    }


}