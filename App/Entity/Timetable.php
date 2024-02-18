<?php
namespace App\Entity;

use DateTime;

Class Timetable
{
  protected ?int $idDay = null;
  protected string $ouvertureAm;
  protected string $fermetureAm;
  protected string $ouverturePm;
  protected string $fermeturePm;
  protected string $day;

  public function __construct(int $idDay, string $ouvertureAm,string $fermetureAm, string $ouverturePm,string $fermeturePm, string $day)
  {
    $this->idDay = $idDay;
    $this->ouvertureAm = $ouvertureAm;
    $this->fermetureAm = $fermetureAm;
    $this->ouverturePm = $ouverturePm;
    $this->fermeturePm = $fermeturePm;
    $this->day = $day;
}

public function getTimetableFormated():string
{
  if($this->ouvertureAm == 'Fermé') {
    if($this->ouverturePm == 'Fermé') {
      return $dayTimetable = $this->day.' : Fermé';
    } else {
      return $dayTimetable = $this->day.' : Fermé /'.$this->ouverturePm.' - '.$this->fermeturePm;
    }
  } else {
    if($this->ouverturePm == 'Fermé') {
    return $dayTimetable = $this->day.' : '.$this->ouvertureAm.' - '.$this->fermetureAm.' / Fermé';
  } else {
    return $dayTimetable = $this->day.' : '.$this->ouvertureAm.' - '.$this->fermetureAm.' / '.$this->ouverturePm.' - '.$this->fermeturePm;
  }
}
}
  /**
   * Get the value of idDay
   */
  public function getIdDay(): ?int
  {
    return $this->idDay;
  }

  /**
   * Set the value of idDay
   */
  public function setIdDay(?int $idDay): self
  {
    $this->idDay = $idDay;

    return $this;
  }

  /**
   * Set the value of ouvertureAm
   */
  public function setOuvertureAm(string $ouvertureAm): self
  {
    $this->ouvertureAm = $ouvertureAm;

    return $this;
  }

  /**
   * Set the value of fermetureAm
   */
  public function setFermetureAm(string $fermetureAm): self
  {
    $this->fermetureAm = $fermetureAm;

    return $this;
  }


  /**
   * Set the value of ouverturePm
   */
  public function setOuverturePm(string $ouverturePm): self
  {
    $this->ouverturePm = $ouverturePm;

    return $this;
  }


  /**
   * Set the value of fermeturePm
   */
  public function setFermeturePm(string $fermeturePm): self
  {
    $this->fermeturePm = $fermeturePm;

    return $this;
  }

  /**
   * Get the value of day
   */
  public function getDay(): string
  {
    return $this->day;
  }

  /**
   * Set the value of day
   */
  public function setDay(string $day): self
  {
    $this->day = $day;

    return $this;
  }

  /**
   * Get the value of ouvertureAm
   */
  public function getOuvertureAm(): string
  {
    return $this->ouvertureAm;
  }

  /**
   * Get the value of fermetureAm
   */
  public function getFermetureAm(): string
  {
    return $this->fermetureAm;
  }

  /**
   * Get the value of ouverturePm
   */
  public function getOuverturePm(): string
  {
    return $this->ouverturePm;
  }

  /**
   * Get the value of fermeturePm
   */
  public function getFermeturePm(): string
  {
    return $this->fermeturePm;
  }
}