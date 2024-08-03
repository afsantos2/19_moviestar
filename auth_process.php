<?php 
  require_once('globals.php');
  require_once('db.php');
  require_once('models/User.php');
  require_once('models/Message.php');
  require_once('dao/UserDAO.php');

  $message = new Message($BASE_URL);

  $userDao = new UserDAO($conn, $BASE_URL);

  // recupera o tipo de formulario
  $type = filter_input(INPUT_POST, "type");

  // varifica o tipo de formulario
  if ($type == 'register') {
    $name = filter_input(INPUT_POST, "type");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // verificacao de dados minimos
    if ($name && $lastname && $email && $password) {

      // verificar se as senhas batem
      if ($password === $confirmpassword) {

        // verificar se o email já está cadastrado no sistema
        if ($userDao->findByEmail($email) === false) {
          
          $user = new User();

          // criação de token e senha
          $userToken = $user->generateToken();
          $finalPassword = $user->generatePassword($password);

          $user->name = $name;
          $user->lastname = $lastname;
          $user->email = $email;
          $user->password = $finalPassword;
          $user->token = $userToken;

          $auth = true;

          $userDao->create($user, $auth);

        } else {

          // enviar uma mensagem de erro, usuario já existe
          $message->setMessage('Usuário já cadastrado, tente outro e-mail.', 'error', 'back');
        }

        
      } else {

        // enviar uma mensagem de erro, de senhas não batem
        $message->setMessage('As senhas não são iguais.', 'error', 'back');
      }

    } else {
      // Enviar uma mensagem de erro, de dados faltantes
      $message->setMessage('Por favor, preencha todos os campos.', 'error', 'back');
    }
  }