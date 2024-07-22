<?php 
  require_once('globals.php');
  require_once('db.php');
  require_once('models/User.php');
  require_once('models/Message.php');
  require_once('dao/UserDAO.php');

  $message = new Message($BASE_URL);

  // recupera o tipo de formulario
  $type = filter_input(INPUT_POST, "type");

  // varifica o tipo de formulario
  if ($type == 'register') {
    $type = filter_input(INPUT_POST, "type");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // verificacao de dados minimos
    if ($name && $lastname && $email && $password) {

    } else {
      // Enviar uma mensagem de erro, de dados faltantes
      $message->setMessage('Por favor, preencha todos os campos.', 'error', 'back');
    }
  }