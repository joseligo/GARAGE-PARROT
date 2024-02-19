<?php

namespace App\Repository;

use App\Entity\Avis;

class AvisRepository extends Repository
{
  public function saveAvis($firstName, $lastName, $comment, $note)
  {
    $comment =htmlspecialchars($comment);
    $sql = "INSERT INTO `Avis` (`id`, `first_name`, `last_name`, `comment`, `note`, `validation`,`date_addition`, `id_user`) VALUES (NULL, :firstName, :lastName, :comment, :note, 0, NOW(), NULL);";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':firstName', $firstName, $this->pdo::PARAM_STR);
    $query->bindParam(':lastName', $lastName, $this->pdo::PARAM_STR);
    $query->bindParam(':comment', $comment, $this->pdo::PARAM_STR);
    $query->bindParam(':note', $note, $this->pdo::PARAM_INT);
    return $query->execute();
  }

  public function getAvis(int $limit = null): array
  {
    $sql = "SELECT * FROM `Avis` WHERE validation = 1 ORDER BY date_addition DESC";

    if ($limit) {
      $sql .= " LIMIT :limit";
    }
    $query = $this->pdo->prepare($sql);
    if ($limit) {
      $query->bindValue(":limit", $limit, $this->pdo::PARAM_INT);
    }
    $query->execute();

    $response = $query->fetchAll($this->pdo::FETCH_ASSOC);

    $listAvis = [];
    foreach ($response as $avis) {
      $avis = new Avis($avis['id'], $avis['first_name'], $avis['last_name'], $avis['comment'], $avis['note'], true, $avis['id_user'], $avis['date_addition']);
      $listAvis[] = $avis;
    };
    return $listAvis;
  }
  public function getAvisDashboard(int $validation): array
  {
    $sql = "SELECT * FROM `Avis` WHERE validation =:validation ORDER BY date_addition DESC";

    $query = $this->pdo->prepare($sql);

    $query->bindValue(":validation", $validation, $this->pdo::PARAM_INT);
    $query->execute();

    $response = $query->fetchAll($this->pdo::FETCH_ASSOC);

    $listAvis = [];
    $validationBool = false;
    $validation === 0 ? $validationBool = false : true;
    foreach ($response as $avis) {
      $avis = new Avis($avis['id'], $avis['first_name'], $avis['last_name'], $avis['comment'], $avis['note'], $validationBool, $avis['id_user'], $avis['date_addition']);
      $listAvis[] = $avis;
    };
    return $listAvis;
  }
  public function validateAvis($id) {
    $sql = "UPDATE `Avis` SET `validation` = 1 WHERE id =:id";
    $query = $this->pdo->prepare($sql);

    $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
    return $query->execute();
  }
  public function deleteAvis($id) {
    $sql = "DELETE FROM `Avis` WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
    $query->execute();
  }
  
}
