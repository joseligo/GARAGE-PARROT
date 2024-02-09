<?php

namespace App\Repository;

if ($_SERVER['PHP_SELF'] === '/App/Repository/UserRepository.php') {
  require_once '../Db/Mysql.php';
}

use App\Db\Mysql;


use App\Entity\User;

class UserRepository
{
  public function findOneByEmail(string $email)
  {
    $mysql = Mysql::getInstance();
    $pdo = $mysql->getPDO();
    $query = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
    $query->bindParam(':email', $email, $pdo::PARAM_STR);
    $query->execute();
    $response = $query->fetch($pdo::FETCH_ASSOC);
    if ($response) {
      $user = new User($response['id'], $response['first_name'], $response['last_name'], $response['email'], $response['password'], $response['role']);
      return $user;
    } else {
      return false;
    }
  }
  function verifyUserLoginPassword(string $email, string $password): array|bool
  {
    $mysql = Mysql::getInstance();
    $pdo = $mysql->getPDO();
    $query = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
    $query->bindValue(":email", $email, $pdo::PARAM_STR);
    $query->execute();
    $user = $query->fetch($pdo::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
      return $user;
    } else {
      return false;
    }
  }
  function openAccessUser(string $firstName, string $lastName, string $email, string $password, string $role)
  {
    $mysql = Mysql::getInstance();
    $pdo = $mysql->getPDO();
    $sql = "INSERT INTO `Users` (`id`,`first_name`, `last_name`, `email`, `password`, `role`) VALUES (NULL, :firstName, :lastName, :email, :password, :role);";
    $query = $pdo->prepare($sql);

    $password = password_hash($password, PASSWORD_BCRYPT);

    $query->bindParam(':firstName', $firstName, $pdo::PARAM_STR);
    $query->bindParam(':lastName', $lastName, $pdo::PARAM_STR);
    $query->bindParam(':email', $email, $pdo::PARAM_STR);
    $query->bindParam(':password', $password, $pdo::PARAM_STR);
    $query->bindParam(':role', $role, $pdo::PARAM_STR);

    return $query->execute();
  }

  function getAllUser()
  {
    $mysql = Mysql::getInstance();
    $pdo = $mysql->getPDO();
    $sql = "SELECT * FROM Users";
    $query = $pdo->prepare($sql);
    $query->execute();

    $response = $query->fetchAll($pdo::FETCH_ASSOC);

    $listUsers = [];
    foreach ($response as $user) {
      $user = new User($user['id'], $user['first_name'], $user['last_name'], $user['email'], $user['password'], $user['role']);
      $listUsers[] = $user;
    };
    return $listUsers;
  }
  function saveUser(string $firstName, string $lastName, string $email)
  {
    $mysql = Mysql::getInstance();
    $pdo = $mysql->getPDO();

    $sql = "INSERT INTO Users (`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES (NULL, :firstName, :lastName, :email, NULL, 'employé');";
    $query = $pdo->prepare($sql);
    $query->bindParam(':firstName', $firstName, $pdo::PARAM_STR);
    $query->bindParam(':lastName', $lastName, $pdo::PARAM_STR);
    $query->bindParam(':email', $email, $pdo::PARAM_STR);
    $query->execute();
    header('location: ../../userAdmin.php');
  }
  public function deleteUser(int $idUser): void
  {
    $mysql = Mysql::getInstance();
    $pdo = $mysql->getPDO();

    $sql = "DELETE FROM `Users` WHERE id = :idUser";
    $query = $pdo->prepare($sql);
    $query->bindValue(":idUser", $idUser, $pdo::PARAM_INT);
    $query->execute();
  }
}
