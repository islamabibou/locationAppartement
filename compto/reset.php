<?php
session_start();
if(isset($_GET['id']) && isset($_GET['token'])){
  require 'bdd/db.php';
  require 'functions/functions.php';

  $req = $pdo->prepare('SELECT * FROM compte WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
  $req->execute([$_GET['id'], $_GET['token']]);
  $user = $req->fetch();
  if($user){
    if(!empty($_POST)){
    if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      $pdo->prepare('UPDATE compte SET passe = ?, reset_at = NULL, reset_token = NULL WHERE id = ?')->execute(array($password, $user->id));
      $_SESSION['flash']['success'] = 'Votre mot de passe a bien été réinitialisé. A présent, connectez-vous pour continuer';
      $_SESSION['auth'] = $user;
      header('Location: login.php');
      exit();
        }
    }
  }else{
  $_SESSION['flash']['danger'] = "Ce lien n'est pas valide ou est erroné";
  header('Location: login.php');
  exit();
}
}else{
    header('Location: login.php');
    exit();
}
    require 'inc/header.php';
    $title = 'Réinitialisation';
?>

<h1 class='text-center'>Réinitialisation</h1>

<ul>
<li><a href="register.php">Ouvrir un compte</a></li>
<li><a href="login.php">Se connecter</a></li>
</ul>
<h4 class='text-center'>Bonjour <span class="text-primary"><?= $user->email ?></span>. Pour la réinitialisation de votre mot de passe, remplissez le formulaire ci-après</h4>

<!------------ msg flash --------->
<?php if(isset($_SESSION['flash'])): ?>
	<?php foreach($_SESSION['flash'] as $type => $message): ?>
		<div class="alert alert-<?= $type; ?>">
			<?= $message ?>
		</div>
	<?php endforeach; ?>

	<?php unset($_SESSION['flash']); ?>
<?php endif; ?>
<!------------ fin flash --------->

<form method="post" action="" class="needs-validation" novalidate>

        <div class="col-md-12 mb-3">
          <label for="password">Entrez le nouveau mot de passe</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><span class="text-primary icon-key"></span></span>
            </div>
          <input type="password" name="password" class="form-control" id="password">
        </div>
        </div>

        <div class="col-md-12 mb-3">
          <label for="passe_c">confirmez le mot de passe</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><span class="text-primary icon-key"></span></span>
            </div>
          <input type="password" name="password_confirm" class="form-control" id="passe_c">
        </div>
        </div>

        <button class="btn btn-primary btn-lg btn-block" type="submit">Valider</button>
      </form><br><br>
  </div>
</div>
<?php require 'inc/footer.php'; ?>
<script>
  bootstrapValidate('#password',"regex:^.{8,20}$:Le mot de passe doit contenir entre huit (8) et vinght (20) caractères!")
</script>