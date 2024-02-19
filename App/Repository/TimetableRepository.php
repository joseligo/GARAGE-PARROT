<?php

namespace App\Repository;
require_once('./App/Entity/Timetable.php');

use App\Entity\Timetable;

class TimetableRepository extends Repository
{
  public function getTimeTable(): array
  {
    $sql = "SELECT * FROM `Timetable` ORDER BY id_day";

    $query = $this->pdo->prepare($sql);
    
    $query->execute();

    $response = $query->fetchAll($this->pdo::FETCH_ASSOC);
    $listdayTimetable = [];
    foreach ($response as $dayTimetable) {
      $timeTable = new Timetable($dayTimetable['id_day'], $dayTimetable['ouverture_am'], $dayTimetable['fermeture_am'], $dayTimetable['ouverture_pm'], $dayTimetable['fermeture_pm'], $dayTimetable['day']);
      $listdayTimetable[] = $timeTable;
    };
    return $listdayTimetable;
  }
  public function saveTimeTable(int $idDay, string $ouvertureAm, string $fermetureAm, string $ouverturePm, string $fermeturePm)
  {
    $sql = "Update Timetable
            SET ouverture_am = :ouvertureAm, fermeture_am = :fermetureAm, ouverture_pm = :ouverturePm, fermeture_pm = :fermeturePm
            WHERE id_day = :idDay";

    $query = $this->pdo->prepare($sql);
    $query->bindParam(':idDay', $idDay, $this->pdo::PARAM_INT);
    $query->bindParam(':ouvertureAm', $ouvertureAm, $this->pdo::PARAM_STR);
    $query->bindParam(':fermetureAm', $fermetureAm, $this->pdo::PARAM_STR);
    $query->bindParam(':ouverturePm', $ouverturePm, $this->pdo::PARAM_STR);
    $query->bindParam(':fermeturePm', $fermeturePm, $this->pdo::PARAM_STR);
    return $query->execute();
  }
}