<?php
  if(!empty($_POST)){

        $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '');
        $req = $pdo->prepare("INSERT INTO reservation SET nom=?, prix=?, caution=?, emplacement=?, message = ?, utilisateur = ?, resoud = ?, id_user = ?");
        $req ->execute([$_POST['name'], $_POST ['price'], $_POST ['caution'], $_POST ['emplacement'], $_POST ['comment'], $_POST ['user'], $_POST ['resolv'], $_POST ['id_user']]);

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
        header("Location: reservation.php?id=".$_GET['id']);
      exit();
    }

    $id = $_GET['id'];
     
    //selecting data associated with this particular id
    $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8']);
    $req = $pdo->prepare("SELECT * FROM appartement WHERE id=:id");
    $req ->execute(array(':id' => $id));
     
    while($entrees = $req->fetch(PDO::FETCH_ASSOC))
    {
        $id = $entrees['id'];
        $nom = $entrees['nom'];
        $quatier = $entrees['quatier'];
        $prix = $entrees['prix'];
        $chambre = $entrees['chambre'];
        $douche = $entrees['douche'];
        $dimension = $entrees['dimension'];
        $salon = $entrees['salon'];
        $adresse = $entrees['adresse'];
        $image = $entrees['image'];
        $emplacement = $entrees['emplacement'];
        $etat = $entrees['etat'];
        $caution = $entrees['caution'];
        $probleme = $entrees['probleme'];
        $video = $entrees['video'];
        $plan = $entrees['plan'];
        $description = $entrees['description'];
    }

      $title = 'RapidAppart | Réservation';
      require 'inc/header.php';
  ?>

  <main id="main">

    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="title-single-box">Réserver maintenant en nous confirmant tout simplement les informations si dessous</h1><br>
              <span class="color-text-a"><img src="compto/rapidappart/appartement/img/<?= $image; ?>" alt="image de l'appartement" class="img-a img-fluid" width=200px></span>
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
              <div class="col-md-7">
    
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
                          <label for="">Nomination de l'appartement</label>
                        <input type="text" name="name" class="form-control form-control-lg form-control-a" value="<?= $nom ?>">
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                          <label for="">Prix de l'appartement</label>
                        <input type="text" name="price" class="form-control form-control-lg form-control-a" value="<?= $prix ?>">
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <label for="">Caution de l'appartement</label>
                        <input type="text" name="caution" class="form-control form-control-lg form-control-a" value="<?= $caution ?>">
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <label for="">Emplacement de l'appartement</label>
                        <input type="text" name="emplacement" class="form-control form-control-lg form-control-a" value="<?= $emplacement ?>">
                      </div>
                    </div>

                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <label for="">Entrez vos coordonnées pour pouvoir vous contacter</label>
                        <input type="text" name="user" class="form-control form-control-lg form-control-a" value="<?= $_SESSION['auth']->email ?? '' ?>" required>
                      </div>
                    </div>

                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <input type="hidden" name="id_user" class="form-control form-control-lg form-control-a" value="<?= $_SESSION['auth']->id_user ?? '' ?>">
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <input type="hidden" name="resolv" class="form-control form-control-lg form-control-a" value="<i class='fas fa-times text-danger'></i>">
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                          <label for="">Description de l'appartement</label>
                        <textarea type="message" name="comment" class="form-control" cols="45" rows="8" id="description"><?= $description ?></textarea>
                      </div>
                    </div>

                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-a">Envoyer</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-5 section-md-t3">
                <div class="icon-box section-b2">
                  <div class="icon-box-icon">
                    <span class="bi bi-envelope"></span>
                  </div>
                  <div class="icon-box-content table-cell">
                    <div class="icon-box-title">
                      <h4 class="icon-title">Contacts</h4>
                    </div>
                    <div class="icon-box-content">
                      <p class="mb-1">Email.
                        <span class="color-a">contact@example.com</span>
                      </p>
                      <p class="mb-1">Appel.
                        <span class="color-a">+54 356 945234</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="icon-box section-b2">
                  <div class="icon-box-icon">
                    <span class="bi bi-geo-alt"></span>
                  </div>
                  <div class="icon-box-content table-cell">
                    <div class="icon-box-title">
                      <h4 class="icon-title">Notre emplacement</h4>
                    </div>
                    <div class="icon-box-content">
                      <p class="mb-1">
                        Manhattan, Nueva York 10036,
                        <br> EE. UU.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="icon-box">
                  <div class="icon-box-icon">
                    <span class="bi bi-share"></span>
                  </div>
                  <div class="icon-box-content table-cell">
                    <div class="icon-box-title">
                      <h4 class="icon-title">Nos réseaux sociaux</h4>
                    </div>
                    <div class="icon-box-content">
                      <div class="socials-footer">
                        <ul class="list-inline">
                          <li class="list-inline-item">
                            <a href="#" class="link-one">
                              <i class="bi bi-facebook" aria-hidden="true"></i>
                            </a>
                          </li>
                          <li class="list-inline-item">
                            <a href="#" class="link-one">
                              <i class="bi bi-twitter" aria-hidden="true"></i>
                            </a>
                          </li>
                          <li class="list-inline-item">
                            <a href="#" class="link-one">
                              <i class="bi bi-instagram" aria-hidden="true"></i>
                            </a>
                          </li>
                          <li class="list-inline-item">
                            <a href="#" class="link-one">
                              <i class="bi bi-linkedin" aria-hidden="true"></i>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
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
  <script src="assets/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace("description");
  </script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>