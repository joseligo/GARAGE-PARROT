<?php

namespace App\Repository;

use App\Entity\Timetable;

class TimetableRepository extends Repository
{
  public function getTimeTable(): array
  {
    $sql = "SELECT * FROM `Timetable` ORDER BY id_day";

    $query = $this->pdo->prepare($sql);
    
    $query->execute();

    $response = $query->fetchAll($this->pdo::FETCH_ASSOC);
    $listTimetable = [];
    foreach ($response as $dayTimetable) {
      $timeTable = new Timetable($dayTimetable['id_day'], $dayTimetable['hour_open1'], $dayTimetable['min_open1'], $dayTimetable['hour_close1'], $dayTimetable['min_close1'], $dayTimetable['hour_open2'], $dayTimetable['min_open2'], $dayTimetable['hour_close2'], $dayTimetable['min_close2'], $dayTimetable['day']);
      $listdayTimetable[] = $timeTable;
    };
    return $listdayTimetable;
  }
}