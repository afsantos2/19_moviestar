<?php 

require_once('globals.php');
require_once('db.php');
require_once('models/User.php');
require_once('models/Message.php');
require_once('dao/UserDAO.php');

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, 'type');

if ($type === 'update') {
  
  // resgata os dados do usuário
  $userData = $userDao->verifyToken();

  // receber os dados do post
  $name = filter_input(INPUT_POST, "name");
  $lastname = filter_input(INPUT_POST, "lastname");
  $email = filter_input(INPUT_POST, "email");
  $bio = filter_input(INPUT_POST, "bio");

  $user = new User();

  $userData->name = $name;
  $userData->lastname = $lastname;
  $userData->email = $email;
  $userData->bio = $bio;

  // upload da imagem
  if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
    $image = $_FILES['image'];
    $imageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    $jpgArray = ['image/jpeg', 'image/jpg'];

    // checagem de tipo de imagem
    if (in_array($image['type'], $imageTypes)) {

      // checar se jpg
      if (in_array($image, $jpgArray)) {
        $imageFile = imagecreatefromjpeg($image['tmp_name']);
      } 
      else {
        $imageFile = imagecreatefrompng($image['tmp_name']);
      }

      $imageName = $user->imageGenerateName();

      imagejpeg($imageFile, './img/users/' . $imageName, 100);

      $userData->image = $imageName;   

    } else {
      $message->setMessage('Tipo invalido de imagem, insira png ou jpg!', 'error', 'back');
    }
  }

  $userDao->update($userData);

} else if($type === 'changepassword') {

} else {
  $message->setMessage('Informações inválidas', 'error', 'index.php');
}