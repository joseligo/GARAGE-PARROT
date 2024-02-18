<?php

namespace App\Repository;

use App\Entity\Contact;


class ContactRepository extends Repository
{
  public function getSubject()
  {

    $sql = "SELECT * FROM `Subject` ORDER BY id_subject";
    $query = $this->pdo->prepare($sql);
    $query->execute();

    $response = $query->fetchAll($this->pdo::FETCH_ASSOC);

    $listSubject = [];
    foreach ($response as $subject) {
      $listSubject[] = [$subject["id_subject"], $subject["subject"]];
    };
    return $listSubject;
  }
  public function saveContact(string $lastName, string $firstName, string $numTel, string $mail, string $comment, int $subject)
  {
    $sql = "INSERT INTO `FormContact` (`id_contact`, `last_name`, `first_name`, `phone_number`, `email`, `comment`,`date_addition`,`id_subject`) VALUES (NULL, :lastName, :firstName, :numTel, :mail, :comment, NOW(), :idSubject);";
    $query = $this->pdo->prepare($sql);
    $query->bindParam(':lastName', $lastName, $this->pdo::PARAM_STR);
    $query->bindParam(':firstName', $firstName, $this->pdo::PARAM_STR);
    $query->bindParam(':numTel', $numTel, $this->pdo::PARAM_STR);
    $query->bindParam(':mail', $mail, $this->pdo::PARAM_STR);
    $query->bindParam(':comment', $comment, $this->pdo::PARAM_STR);
    $query->bindParam(':idSubject', $subject, $this->pdo::PARAM_INT);
    return $query->execute();
  }
  public function getFormContact(): array
  {

    $sql = "SELECT * FROM `FormContact`
    LEFT JOIN Subject ON FormContact.id_subject = Subject.id_subject;";
    $query = $this->pdo->prepare($sql);
    $query->execute();

    $response = $query->fetchAll($this->pdo::FETCH_ASSOC);

    $listFormContact = [];
    foreach ($response as $formContact) {
      $formContact = new Contact($formContact['id_contact'], $formContact['first_name'], $formContact['last_name'], $formContact['phone_number'], $formContact['email'], $formContact['comment'], $formContact['date_addition'], $formContact['subject']);
      $listFormContact[] = $formContact;
    };
    return $listFormContact;
  }
  public function deleteFormContact(int $idContact):bool
  {
    $sql = "DELETE FROM `FormContact` WHERE id_contact = :idContact";
    $query = $this->pdo->prepare($sql);
    $query->bindValue(":idContact", $idContact, $this->pdo::PARAM_INT);
    return $query->execute();
  }
}
