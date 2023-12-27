<?php
namespace App\Entity;

Class Timetable
{
  protected ?int $idDay = null;
  protected int $hourOpen1;
  protected int $minOpen1;
  protected int $hourClose1;
  protected int $minClose1;
  protected int $hourOpen2;
  protected int $minOpen2;
  protected int $hourClose2;
  protected int $minClose2;
  protected string $day;

  public function __construct(int $idDay, int $hourOpen1,int $minOpen1, int $hourClose1, int $minClose1, int $hourOpen2, int $minOpen2, int $hourClose2, int $minClose2, string $day)
  {
    $this->idDay = $idDay;
    $this->hourOpen1 = $hourOpen1;
    $this->minOpen1 = $minOpen1;
    $this->hourClose1 = $hourClose1;
    $this->minClose1 = $minClose1;
    $this->hourOpen2 = $hourOpen2;
    $this->minOpen2 = $minOpen2;
    $this->hourClose2 = $hourClose2;
    $this->minClose2 = $minClose2;
    $this->day = $day;
}

public function getTimetableFormated():string
{
  return $dayTimetable = $this->day.' : '.$this->hourOpen1.':'.$this->minOpen1.' - '.$this->hourClose1.':'.$this->minClose1.' / '.$this->hourOpen2.':'.$this->minOpen2.' - '.$this->hourClose2.':'.$this->minClose2;
}

  /**
   * Get the value of day
   */
  public function getDay(): string
  {
    return $this->day;
  }

  /**
   * Get the value of idDay
   */
  public function getIdDay(): ?int
  {
    return $this->idDay;
  }
}