<?php
namespace App\Entity;

use App\Tools\StringTools;


Class Avis 
{
  protected ?int $id = null;
  protected string $firstName;
  protected string $lastName;
  protected string $comment;
  protected int $note;
  protected bool $validation;
  protected ?int $idUser = null;
  protected string $dateAddition;

  /**
   * Get the value of id
   */
  public function getId(): ?int
  {
    return $this->id;
  }
  /**
   * Set the value of id
   */
  public function setId(?int $id): self
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of first_name
   */
  public function getFirstName(): string
  {
    return $this->firstName;
  }

  /**
   * Set the value of first_name
   */
  public function setFirstName(string $first_name): self
  {
    $this->firstName = $first_name;

    return $this;
  }

  /**
   * Get the value of last_name
   */
  public function getLastName(): string
  {
    return $this->lastName;
  }

  /**
   * Set the value of last_name
   */
  public function setLastName(string $lastName): self
  {
    $this->lastName = $lastName;

    return $this;
  }

  /**
   * Get the value of comment
   */
  public function getComment(): string
  {
    return $this->comment;
  }

  /**
   * Set the value of comment
   */
  public function setComment(string $comment): self
  {
    $this->comment = $comment;

    return $this;
  }

  /**
   * Get the value of note
   */
  public function getNote(): int
  {
    return $this->note;
  }

  /**
   * Set the value of note
   */
  public function setNote(int $note): self
  {
    $this->note = $note;

    return $this;
  }

  /**
   * Get the value of validation
   */
  public function isValidation(): bool
  {
    return $this->validation;
  }

  /**
   * Set the value of validation
   */
  public function setValidation(bool $validation): self
  {
    $this->validation = $validation;

    return $this;
  }

  /**
   * Get the value of id_User
   */
  public function getIdUser(): int|null
  {
    return $this->idUser;
  }

  /**
   * Set the value of id_User
   */
  public function setIdUser(int $idUser): self
  {
    $this->idUser = $idUser;

    return $this;
  }
  /**
   * Get the value of date_addition
   */
  public function getDateAddition(): string
  {
    return $this->dateAddition;
  }

  /**
   * Set the value of date_addition
   */
  public function setDateAddition(string $dateAddition): self
  {
    $this->dateAddition = $dateAddition;

    return $this;
  }

  // getter for name like John D.
  public function getName(): string
  {
    $name = StringTools::anonymName($this->firstName, $this->lastName);
    return $name;
  }

  //getter for date formated like 23/09/23
  public function getDateFormated(): string
  {
    $date= new \DateTime($this->dateAddition);
    $dateFormated = $date->format('d-m-y');
    return $dateFormated;
  }
  public function __construct(int $id, string $first_name,string $last_name, string $comment, int $note, bool|null $validation, int|null $id_user, string $date_addition)
  {
    $this->id = $id;
    $this->firstName = $first_name;
    $this->lastName = $last_name;
    $this->comment = $comment;
    $this->note = $note;
    $this->validation = $validation;
    $this->idUser = $id_user;
    $this->dateAddition = $date_addition;

  }

  
}

  