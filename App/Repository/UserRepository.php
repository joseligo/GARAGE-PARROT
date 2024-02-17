<?php

namespace App\Repository;


use App\Entity\User;

class UserRepository extends Repository
{
  public function findOneByEmail(string $email)
  {
    $query = $this->pdo->prepare("SELECT * FROM Users WHERE email = :email");
    $query->bindParam(':email', $email, $this->pdo::PARAM_STR);
    $query->execute();
    $response = $query->fetch($this->pdo::FETCH_ASSOC);
    if ($response) {
      $user = new User($response['id'], $response['first_name'], $response['last_name'], $response['email'], $response['password'], $response['role']);
      return $user;
    } else {
      return false;
    }
  }
  public function findOneById(int $id)
  {
    $query = $this->pdo->prepare("SELECT * FROM Users WHERE id = :id");
    $query->bindParam(':id', $id, $this->pdo::PARAM_INT);
    $query->execute();
    $response = $query->fetch($this->pdo::FETCH_ASSOC);
    if ($response) {
      $user = new User($response['id'], $response['first_name'], $response['last_name'], $response['email'], $response['password'], $response['role']);
      return $user;
    } else {
      return false;
    }
  }
  function verifyUserLoginPassword(string $email, string $password): array|bool
  {
    $query = $this->pdo->prepare("SELECT * FROM Users WHERE email = :email");
    $query->bindValue(":email", $email, $this->pdo::PARAM_STR);
    $query->execute();
    $user = $query->fetch($this->pdo::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
      return $user;
    } else {
      return false;
    }
  }
  function getAllUser()
  {
    $sql = "SELECT * FROM Users";
    $query = $this->pdo->prepare($sql);
    $query->execute();

    $response = $query->fetchAll($this->pdo::FETCH_ASSOC);

    $listUsers = [];
    foreach ($response as $user) {
      $user = new User($user['id'], $user['first_name'], $user['last_name'], $user['email'], $user['password'], $user['role']);
      $listUsers[] = $user;
    };
    return $listUsers;
  }
  function saveUser(string $firstName, string $lastName, string $email, string $password, string $role)
  {
    $sql = "INSERT INTO Users (`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES (NULL, :firstName, :lastName, :email, :password, :role);";
    $query = $this->pdo->prepare($sql);

    $password = password_hash($password, PASSWORD_BCRYPT);

    $query->bindParam(':firstName', $firstName, $this->pdo::PARAM_STR);
    $query->bindParam(':lastName', $lastName, $this->pdo::PARAM_STR);
    $query->bindParam(':email', $email, $this->pdo::PARAM_STR);
    $query->bindParam(':password', $password, $this->pdo::PARAM_STR);
    $query->bindParam(':role', $role, $this->pdo::PARAM_STR);
    $res = $query->execute();

    if ($res) {
      $user = new User($this->pdo->lastInsertId(), $firstName, $lastName, $email, $password, $role);
      return $user;
    } else {
      throw new \Exception("Erreur lors de l'enregistrement");
    }
  }
  public function deleteUser(int $idUser): bool
  {
    $sql = "DELETE FROM `Users` WHERE id = :idUser";
    $query = $this->pdo->prepare($sql);
    $query->bindValue(":idUser", $idUser, $this->pdo::PARAM_INT);
    $res = $query->execute();
    if ($res) {
      return true;
    } else {
      return false;
    }
  }
  function editUser(int $idUser, string $firstName, string $lastName, string $email, string $role)
  {
    $sql = "UPDATE Users 
            SET `first_name` = :firstName, `last_name`= :lastName, `email` = :email, `role` = :role
            WHERE id = :idUser;";
    $query = $this->pdo->prepare($sql);

    $query->bindParam(':idUser', $idUser, $this->pdo::PARAM_STR);
    $query->bindParam(':firstName', $firstName, $this->pdo::PARAM_STR);
    $query->bindParam(':lastName', $lastName, $this->pdo::PARAM_STR);
    $query->bindParam(':email', $email, $this->pdo::PARAM_STR);
    $query->bindParam(':role', $role, $this->pdo::PARAM_STR);
    $res = $query->execute();

    if ($res) {
      $user = $this->findOneById($idUser);
      return $user;
    } else {
      throw new \Exception("Erreur lors de l'enregistrement");
    }
  }
}
