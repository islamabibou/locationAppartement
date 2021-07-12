<?php

  if(!empty($_POST)){

        $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ]);
        $req = $pdo->prepare("INSERT INTO plaintes SET nom=?, email=?, objet=?, message = ?");
        $req ->execute([$_POST['name'], $_POST ['mail'], $_POST ['subject'], $_POST ['comment']]);

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
        header('Location: les_reservations.php');
      exit();
    }

      $title = 'RapidAppart | contact';
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
        <?php
          $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '', [
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
          ]);
          $id_user = $_SESSION['auth']->id_user;
          $reserve = $pdo->prepare("SELECT * FROM reservation WHERE id_user = $id_user");
          $reserve->execute();
          $reserves = $reserve->rowCount('id_user');
        ?>
        <div style="display:flex;justify-content:space-between;align-items:center;">
          <h2><u>Nombre de plantes: </u><?= $reserves ?></h2>
          <h3>Les informations des appartements réservés</h3>
        </div>

        <table class="table table-striped">
          <thead>
            <tr style="background: #000; color: #fff;">
              <th class="text-center">Nom</th>
              <th class="text-center">Prix</th>
              <th class="text-center">Causion à payer</th>
              <th class="text-center">Traité ou non</th>
              <th class="text-center">Sup</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ]);
            $id_user = $_SESSION['auth']->id_user;

            $listes = $pdo->prepare("SELECT * FROM reservation WHERE id_user = $id_user");
            $listes->execute();

            foreach($listes as $liste):
            ?>
            <tr>
              <td class="text-center"><br><?= $liste['nom']; ?></td>
              <td class="text-center"><br><?= $liste['prix']; ?></td>
              <td class="text-center"><br><?= $liste['caution']; ?></td>
              <td class="text-center"><br><?= $liste['resoud']; ?></td>
              <td class="text-center"><br>
              <form action="code_reserve.php" method="post">
                <input type="hidden" name="delete_id" value="<?= $liste['id']; ?>">
                <button type="submit" class="btn btn-outline-danger" onclick = "return confirm ('Vous êtes sûr le point de supprimer l\'appartement n° <?= $liste['id']; ?>. Êtes-vous sûr de cette action?')"><i class="fas fa-trash-alt"></i></button>
              </form>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
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