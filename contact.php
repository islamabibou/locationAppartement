<?php
  if(!empty($_POST)){

        $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '');
        $req = $pdo->prepare("INSERT INTO rapidappart SET nom=?, email=?, objet=?, message = ?");
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
        header('Location: contact.php');
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
              <h1 class="title-single">Entrez en contact avec nous maintenant</h1>
              <span class="color-text-a">Aut voluptas consequatur unde sed omnis ex placeat quis eos. Aut natus officia corrupti qui autem fugit consectetur quo. Et ipsum eveniet laboriosam voluptas beatae possimus qui ducimus. Et voluptatem deleniti. Voluptatum voluptatibus amet. Et esse sed omnis inventore hic culpa.</span>
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
                        <input type="text" name="name" class="form-control form-control-lg form-control-a" placeholder="Entrer votre prénom" required>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <input type="email" name="mail" class="form-control form-control-lg form-control-a" placeholder="Entrer votre adresse email" required>
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <input type="text" name="subject" class="form-control form-control-lg form-control-a" placeholder="Entrer votre l'objet de votre message ici!">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea type="message" name="comment" class="form-control" cols="45" rows="8" placeholder="Ecrivez votre message ici!" required></textarea>
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
          <div class="col-sm-12">
            <div class="contact-map box">
              <div id="map" class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
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

</body>

</html>