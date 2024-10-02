<?php 
require_once('templates/header.php');
require_once('models/User.php');
require_once('dao/UserDAO.php');

$user = new User();
$userDao = new UserDAO($conn, $BASE_URL);

// requer autenticação nessa página
$userData = $userDao->verifyToken(true);

$fullName = $user->getFullName($userData);

if ($userData->image == '') {
  $userData->image = 'user.png';
}
?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <form action="<?= $BASE_URL ?>user_process.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="type" value="update">
        <div class="row">
          <div class="col-md-4">
            <h1><?=$fullName?></h1>
            <p class="page-description">Altere seus dados no formulário abaixo:</p>
            <div class="form-group">
              <label for="name"></label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Digite seu nome" value="<?= $userData->name ?>">
            </div>
            <div class="form-group">
              <label for="lastname"></label>
              <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Digite seu nome" value="<?= $userData->lastname ?>">
            </div>
            <div class="form-group">
              <label for="email"></label>

              <!-- O atributo "readonly" não permite alteração nos dados mas os envia mesmo assim -->
              <input type="text" readonly name="email" id="email" class="form-control disabled" placeholder="Digite seu nome" value="<?= $userData->email ?>">
            </div>
            <input type="submit" class="btn form-btn" value="Alterar">
          </div>
          <div class="col-md-4">
            <div id="profile-image-container" style="background-image:url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
            <div class="form-group">
              <label for="image"></label>
              <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <div class="form-group">
              <label for="bio">Sobre você:</label>
              <textarea class="form-control" name="bio" id="bio" rows="5"><?= $userData->bio ?></textarea>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php 
require_once('templates/footer.php');
?>