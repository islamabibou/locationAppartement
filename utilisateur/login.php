<?php
session_start();
if(!empty($_POST) && !empty($_POST['password'])){
    require_once 'bdd/db.php';
    require_once 'functions/functions.php';
    $req = $pdo->prepare('SELECT * FROM utilisateur WHERE email = :email AND confirmed_at IS NOT NULL');
    $req->execute(array('email' => $_POST['mail']));
    $user = $req->fetch();
    if(password_verify($_POST['password'], $user->passe)){
    $_SESSION['auth'] = $user;
	  $_SESSION['flash']['success'] = "Vous êtes maintenant connecté";
    header('Location: ../index.php');
    exit();
    }else{
	  $_SESSION['flash']['danger'] = "L'identifiant ou le mot de passe que vous avez entré est mauvais ou vous n'avez pas encore vérifié votre compte et dans ce cas, un mail de confirmation vous a été envoyé dans votre boîte e-mail pour valider votre compte.";
    header('Location: login.php');
    exit();
    }
  }
    $title = 'Connexion';
    require 'inc/header.php';
?>


<h1 class='text-center'>Se connecter</h1>

<ul>
<li><a href="register.php">Ouvrir un compte</a></li>
<li><a href="forget.php">Mot de passe oublié</a></li>
</ul>
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

<form method="post" action="">

        <div class="col-md-12 mb-3">
          <label for="id">Entrez votre adresse email</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><span class="text-primary icon-envelop"></span></span>
            </div>
            <input type="email" name="mail" class="form-control" id="id" value="<?= $_POST['mail'] ?? ''; ?>" required>
          </div>
        </div>

        <div class="col-md-12 mb-3">
          <label>Entrez votre mot de passe</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><span class="text-primary icon-key"></span></span>
            </div>
          <input type="password" name="password" class="form-control">
        </div>
        </div>

		<!-- <div class="form-group">
			<label>
				<input type="checkbox" name="remember" value="1"> Se souvenir de moi
			</label>
		</div> -->

        <hr class="mb-4">
        <small class="text-muted">Avec nous, vos informations sont en sécurité!</small>

        <button class="btn btn-primary btn-lg btn-block" type="submit">Se connecter</button>
      </form><br><br>
  </div>
</div>
<?php require 'inc/footer.php'; ?>