<?php

namespace App\Entity;

Class Contact
{
  protected ?int $idContact = null;
  protected string $firstName;
  protected string $lastName;
  protected string $phoneNumber;
  protected string $email;
  protected string $comment;
  protected string $date;
  protected string $subject;
  
  public function __construct(int $idContact, string $firstName,string $lastName, string $phoneNumber, string $email, string $comment, string $date, string $subject)
  {
    $this->idContact = $idContact;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->phoneNumber = $phoneNumber;
    $this->email = $email;
    $this->comment = $comment;
    $this->date = $date;
    $this->subject = $subject;
  }

  /**
   * Get the value of idContact
   */
  public function getIdContact(): ?int
  {
    return $this->idContact;
  }

  /**
   * Get the value of firstFame
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
   * Get the value of phoneNumber
   */
  public function getPhoneNumber(): string
  {
    return $this->phoneNumber;
  }

  /**
   * Get the value of email
   */
  public function getEmail(): string
  {
    return $this->email;
  }

  /**
   * Get the value of comment
   */
  public function getComment(): string
  {
    return $this->comment;
  }

  /**
   * Get the value of subject
   */
  public function getSubject(): string
  {
    return $this->subject;
  }

  /**
   * Get the value of date
   */
  public function getDate(): string
  {
    return $this->date;
  }
  //getter for date formated like 23/09/23
  public function getDateFormated(): string
  {
    $date= new \DateTime($this->date);
    $dateFormated = $date->format('d-m-y');
    return $dateFormated;
  }

  /**
   * Set the value of date
   */
  public function setDate(string $date): self
  {
    $this->date = $date;

    return $this;
  }
}