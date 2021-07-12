<?php
if(!empty($_POST) && !empty($_POST['mail'])){
  require_once 'bdd/db.php';
  require_once 'functions/functions.php';

  $req = $pdo-> prepare('SELECT * FROM utilisateur WHERE email = ? AND confirmed_at IS NOT NULL');
  $req-> execute(array($_POST['mail']));
  $user = $req-> fetch();
  if($user){
    session_start();
    $reset_token = str_random(60);
    $pdo->prepare('UPDATE utilisateur SET reset_token = ?, reset_at = NOW() WHERE id_user = ?')->execute(array($reset_token, $user->id_user));
    $_SESSION['flash']['success'] = "les instructions pour la réinitilisation de votre mot de passe ont été envoyées dans votre boîte email.<br> <strong>Veuillez consulter votre boîte email afin de passer à la réinitialisation car les instructions de réinitialisation expireront dans 30 minutes</strong>";

    /*$headers[] = 'From: CmaChanX <support@cmachanx.com>';
    mail($_POST['mail'], 'Réinitialisation de votre mot de passe', "Merci de bien vouloir cliquer sur le lien ci-après pour la réinitialisation de votre mot de passe: https://www.cmachanx.com/bureau/compte/reset.php?id_user={$user->id_user}&token=$reset_token\n\n
    Si vous n'êtes pas l'auteur de ce changement, veuiller nous le notifier en répondant à cet e-mail. Mais si ce n'est pas le cas, abstenez-vous svp!\n\nNB: le lien de réinitialisation durera 30 minutes avant d'expirer", implode("\r\n", $headers));*/

    header('Location: login.php');
    exit();
  }else{
    session_start();
    $_SESSION['flash']['danger'] = "Désolé, aucun compte ne correspond à l'adresse e-mail entré";
  }
}
    require 'inc/header.php';
    $title = 'Oublie de mot de passe';
    ?>
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="bootstrap/img/richard.png" alt="" width="72" height="72">
    <h2>Vérification</h2>


    <p class="lead">Merci de bien vouloir renseigner votre adresse pour vérifier votre compte et enclencher la réinitialisation de votre mot de passe.</p>
    <ul class="text-left">
      <li><a href="register.php">Ouvrir un compte</a></li>
      <li><a href="login.php">Se connecter</a></li>
    </ul>
  </div>
    <div class="col-md-12 order-md-1">
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
        <div class="col-md-12 mb-3">
          <label>Entrez votre adresse email</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><span class="text-primary 
                icon-envelop"></span></span>
            </div>
          <input type="email" name="mail" class="form-control">
        </div>
        </div>

        <button class="btn btn-primary btn-lg btn-block" type="submit">Valider</button>
      </form><br><br>
      </div>
    </div>
  <?php require 'inc/footer.php'; ?>