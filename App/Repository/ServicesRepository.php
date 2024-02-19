<?php

namespace App\Repository;

use App\Entity\Service;
use App\Tools\StringTools;

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
  public function getServiceById(int $id):object
  {
    $sql = "SELECT id_service, title, comment, picture, last_name as author FROM Services
    LEFT JOIN Users ON Services.id_user = Users.id;
    WHERE id_service = :idService";
    $query = $this->pdo->prepare($sql);
    $query->execute();

    $response = $query->fetch($this->pdo::FETCH_ASSOC);
    $service = new Service($response['id_service'], $response['title'], $response['comment'], $response['picture'], $response['author']);
    
    return $service;
  }
  public function editService(int $id, string $title, string $comment, $picture, $idUser)
  {
    $comment =htmlspecialchars($comment);

    $sql = "UPDATE `Services` 
              SET `title` = :title, `comment` = :comment, 
              `picture` = :picture, `id_user` = :idUser
              WHERE id_service = :idService;";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':idService', $id, $this->pdo::PARAM_INT);
    $query->bindParam(':title', $title, $this->pdo::PARAM_STR);
    $query->bindParam(':comment', $comment, $this->pdo::PARAM_STR);
    $query->bindParam(':picture', $picture, $this->pdo::PARAM_STR);
    $query->bindParam(':idUser', $idUser, $this->pdo::PARAM_INT);
    $query->execute();
  }
  public function saveImage($file)
  {
    $fileName = null;
    if (isset($file) && $file != '') {

      $checkImage = getimagesize($file['tmp_name']);
      if ($checkImage !== false) {
        $fileName = uniqid() . '-' . StringTools::formatNameImage($file);
        move_uploaded_file($file['tmp_name'], './assets/images/' . $fileName);
        return $fileName;
      }
    }
  }
}
