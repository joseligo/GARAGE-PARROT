<?php 

use App\Entity\Car;
echo('test');
var_dump($_POST, $_FILES);

try {
  $errors = [];
  $car = new Car();

  if (isset($_POST['saveUser'])) {
      
      $user->hydrate($_POST);
      $user->setRole(ROLE_USER);

      $errors = $user->validate();

      if (empty($errors)) {
          $userRepository = new UserRepository();
          
          $userRepository->persist($user);
          header('Location: index.php?controller=auth&action=login');
      }
  }

  $this->render('user/add_edit', [
      'user' => '',
      'pageTitle' => 'Inscription',
      'errors' => $errors
  ]);

} catch (\Exception $e) {
  $this->render('errors/default', [
      'error' => $e->getMessage()
  ]);
} 