<?php

namespace App\Repository;

use App\Entity\Service;

class ServicesRepository extends Repository
{
  public function getServices(int $limit = null):array
  {
    $sql = "SELECT id_service, title, comment, picture, last_name as author FROM Services
    LEFT JOIN Users ON Services.id_user = Users.id;";

    if ($limit) {
      $sql .= " LIMIT :limit";
    }
    $query = $this->pdo->prepare($sql);
    if ($limit) {
      $query->bindValue(":limit", $limit, $this->pdo::PARAM_INT);
    }
    $query->execute();

    $response = $query->fetchAll($this->pdo::FETCH_ASSOC);

    $listServices = [];
    foreach ($response as $service) {
      $service = new Service($service['id_service'], $service['title'], $service['comment'], $service['picture'], $service['author']);
      $listServices[] = $service;
    };
    return $listServices;
  }
}
