<?php
  if(!empty($_POST)){

        $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '');
        $req = $pdo->prepare("INSERT INTO plaintes SET nom=?, email=?, objet=?, message = ?, id_user = ?");
        $req ->execute([$_POST['name'], $_POST ['mail'], $_POST ['subject'], $_POST ['comment'], $_POST ['id_user']]);

        // if(isset($_POST['mail'])){
        //     $entete  = 'MIME-Version: 1.0' . "\r\n";
        //     $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        //     $entete .= 'From: ' . $_POST['mail'] . "\r\n";
    
        //     $message = '<h1>Demande de crédit</h1>
        //     <p><b>Nom : </b>' . $_POST['name'] . '<br>
        //     <b>Email : </b>' . $_POST['mail'] . '<br>
        //     <b>Montant : </b>' . $_POST['subject'] . '<br>
        //     <b>Message : </b>' . $_POST['comment'] .'</p>';
    
        //     $retour = mail('contact@gmail.com', 'Demande de crédit', $message, $entete);
        // }
        session_start();
        $_SESSION['flash']['success'] = "Message reçu avec succes. Nous prennons en compte votre requête et nous promettons de revenir vers vous très prochainement!";
        header('Location: plaintes.php');
      exit();
    }

      $title = 'RapidAppart | Plaintes';
      require 'inc/header.php';
  ?>

  <main id="main">

    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="title-single-box">
              <h1 class="title-single">Plaintes/ ticket</h1>
              <span class="color-text-a">Vous avez une inquiètude, remplissez le formulaire ci-après pour déposer de plaintes.</span>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Intro Single-->

    <!-- ======= Contact Single ======= -->
    <section class="contact">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 section-t8">
            <div class="row">
              <div class="col-md-12">
    
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

                <form action="" method="post" role="form" class="php-email-form">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-lg form-control-a" placeholder="Entrer votre nom complet ici!" required>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <input type="email" name="mail" class="form-control form-control-lg form-control-a" placeholder="Entrer votre adresse email" value="<?= $_SESSION['auth']->email ?? ''; ?>" required>
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <input type="text" name="subject" class="form-control form-control-lg form-control-a" placeholder="Entrer l'objet de votre plainte/ ticket ici!">
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <input type="hidden" name="id_user" class="form-control form-control-lg form-control-a" value="<?= $_SESSION['auth']->id_user ?>">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea type="message" name="comment" class="form-control" cols="45" rows="8" id="comment" placeholder="Détailléz votre painte/ ticket ici!" required></textarea>
                      </div>
                    </div>

                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-a">Envoyer</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Single-->

  </main><!-- End #main -->

<?php
    require 'inc/footer.php';
?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace("comment");
  </script>

</body>

</html>