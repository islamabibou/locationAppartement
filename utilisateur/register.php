<?php
  require_once 'functions/functions.php';
  require_once 'bdd/db.php';
  session_start();
  if(!empty($_POST) && !empty($_POST['password'])){

      $errors=array();

      if(empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
        $errors['mail']="Cet email est déjà utilisé pour un autre compte";
      } else {
        $req = $pdo->prepare('SELECT id_user FROM utilisateur WHERE email = ?');
        $req->execute(array($_POST['mail']));
        $user = $req->fetch();
        if($user){
          $errors['mail'] = "L'adresse e-mail saisie est déjà prise";
        }
      }

      if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm'] || !preg_match('/^.{8,20}$/', $_POST['password'])){
        $errors['password']="Les mots de passe ne correspondent pas et doivent contenir entre 8 à 20 caractères";
      }

      if(empty($errors)){
        $req = $pdo->prepare("INSERT INTO utilisateur SET email=?, passe=?, confirmation_token = ?");
        $user = $req->fetch();
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = str_random(60);
        $req ->execute(array($_POST ['mail'], $password, $token));
        $user_id = $pdo->LastInsertId();
        
        /*if(isset($_POST['mail'])){
          $entete  = 'MIME-Version: 1.0' . "\r\n";
          $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
          $entete .= 'From: CmaChanX <support@cmachanx.com>' . "\r\n";
        
          $retour = mail($_POST['email'], "Message de confirmation de votre compte", "Merci de bien vouloir cliquer sur le lien ci-après pour confirmer votre compte.<br>
          Lien: https://www.cmachanx.com/bureau/compte/confirm.php?id_user=$user_id&token=$token<br>
          L'équipe CmaChanX vous remercie", $entete);
        }
        
        if(isset($_POST['mail'])){
          $entete  = 'MIME-Version: 1.0' . "\r\n";
          $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
          $entete .= 'From: ' . $_POST['email'] . "\r\n";
  
          $message = '<h1>Notification d\'inscripion</h1>
          <p><b>Email : </b>' . $_POST['email'] .'</p>';
  
          $retour = mail('support@cmachanx.com', 'inscription', $message, $entete);
        }*/
        $_SESSION['flash']['success'] = "Un email de confirmation vous a été envoyé pour valider votre compte. Veuillez ne pas oublier de consulter vos spam ou message indésirable!<br><br> Merci de bien vouloir prendre quelques secondes pour achever ceci, car c'est primondiale et cela ne se fera rien que cette fois-ci. Vous pouvez consulter votre votre boîte email en <a href='http://mail.google.com' target='_blanck'>cliquant ici</a> !";
        header('Location: login.php');
      exit();
      }
  }
  ?>
  <?php
    $title = 'Inscription';
    require 'inc/header.php';
    ?>
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="bootstrap/img/richard.png" alt="" width="72" height="72">
    <h2>Inscription</h2>
    
    <ul class="text-left">
    <li><a href="login.php">Se connecter</a></li>
    <li><a href="forget.php">Mot de passe oublié</a></li>
    </ul>

    <p class="lead">En vous inscrivant, vous créez non seulement un compte utilisateur mais aussi votre bureau de travail personnel. Pour accéder à votre bureau de travail,<a href="https://www.cmachanx.com/bureau/compte/login.php"> cliquez ici</a>!</p>
  </div>
    <div class="col-md-12 order-md-1">
    <!--------------msg d'erreurs------------>
    <?php if(!empty($errors)): ?>
      <div class="alert alert-danger">
        <p>Détection d'erreurs</p>
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <!------------------fin msg--------------->
      <form method="post" action="">

          <div class="col-md-12 mb-3">
            <label>Entrez votre adresse e-mail</label>
            <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><span class="text-primary icon-envelop"></span></span>
            </div>
            <input type="email" name="mail" id="mail" class="form-control <?= isset($errors['mail']) ? 'is-invalid' : '' ?>" placeholder="exemple@gmail.com" value="<?= $_POST['mail'] ?? ''; ?>" required>
          </div>
          </div>

        <div class="col-md-12 mb-3">
          <label for="passe">Choisissez votre mot de passe</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><span class="text-primary icon-key"></span></span>
            </div>
            <input type="password" name="password" id="password" class="form-control"  required>
          </div>
        </div>

        <div class="col-md-12 mb-3">
          <label for="passe">Confirmez le mot de passe</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><span class="text-primary 
                icon-key"></span></span>
            </div>
          <input type="password" name="password_confirm" id="password_confirm" class="form-control" id="passe">
        </div>
        </div>

        <small class="text-muted">Avec nous, vos informations ne sont point divulguées!</small>

        <button class="btn btn-primary btn-lg btn-block" type="submit">Soumettre</button>
      </form><br><br>
    </div>
  </div>
<?php require 'inc/footer.php'; ?>
<script>
  bootstrapValidate('#mail',"email:Veuillez entrer une adresse e-mail valide svp!|required:Ce champ ne peut être vide!")
  bootstrapValidate('#password',"regex:^.{8,20}$:Le mot de passe doit contenir entre huit (8) et vinght (20) caractères!")
</script>