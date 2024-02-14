<?php

namespace App\Entity;

class User
{
  protected ?int $id = null;
  protected string $firstName;
  protected string $lastName;
  protected string $email;
  protected ?string $password=null;
  protected string $role;

  public function __construct(int $id, string $firstName, string $lastName, string $email, string|null $password, string $role)
  {
    $this->id = $id;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->password = $password;
    $this->role = $role;
  }
  /**
   * Get the value of firstName
   */
  public function getFirstName(): string
  {
    return $this->firstName;
  }
  /**
   * Get the value of lastName
   */
  public function getLastName(): string
  {
    return $this->lastName;
  }
  /**
   * Get the value of email
   */
  public function getEmail(): string
  {
    return $this->email;
  }
  /**
   * Get the value of role
   */
  public function getRole(): string
  {
    return $this->role;
  }

  /**
   * Get the value of id
   */
  public function getId(): ?int
  {
    return $this->id;
  }
  public static function isLogged(): bool
    {
        return isset($_SESSION['user']);
    }
    public static function adminOnly(): bool
    {
        return $_SESSION['user']['role'] == 'admin';
    }
}