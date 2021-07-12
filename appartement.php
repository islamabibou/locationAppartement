<?php
      $title = 'RapidAppart | appartement';
      require 'inc/header.php';
  ?>

  <main id="main">

    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="title-single-box">
              <h1 class="title-single">Les appartements</h1>
              <span class="color-text-a">disponibles</span>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Intro Single-->

    <!-- ======= Property Grid ======= -->
    <section class="property-grid grid">
      <div class="container">
        <div class="row">

          <?php 
            $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ]);

            $listes = $pdo->prepare("SELECT * FROM appartement");
            $listes->execute();

            foreach($listes as $liste):
          ?>

          <div class="col-md-4">
            <div class="col-md-12 mt-3 text-center mt-5">
              <a href="reservation.php?id=<?= $liste['id']; ?>"><button class="btn btn-a">Réserver cet appartement</button></a>
            </div>
            <div class="card-box-a card-shadow">
              <div class="img-box-a">
                <img src="compto/rapidappart/appartement/img/<?= $liste['image']; ?>" alt="image de l'appartement" class="img-a img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-overlay-a-content">
                  <div class="card-header-a">
                    <h2 class="card-title-a">
                      <a href="#"><?= $liste['nom']; ?>
                        <br />Dakar/ <?= $liste['quatier']; ?></a>
                    </h2>
                  </div>
                  <div class="card-body-a">
                    <div class="price-box d-flex">
                      <span class="price-a"><?= $liste['prix']; ?>/ mois</span>
                    </div>
                    <a href="detailAppartement.php?id=<?= $liste['id']; ?>" class="link-a btn btn-success">Voir détail
                      <span class="bi bi-chevron-right"></span>
                    </a>
                  </div>
                  <div class="card-footer-a">
                      <ul class="card-info d-flex justify-content-around">
                        <li>
                          <h4 class="card-info-title">Dimension</h4>
                          <span><?= $liste['dimension']; ?>
                          </span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Chambres</h4>
                          <span><?= $liste['chambre']; ?></span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Douches</h4>
                          <span><?= $liste['douche']; ?></span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Salon</h4>
                          <span><?= $liste['salon']; ?></span>
                        </li>
                      </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <nav class="pagination-a">
              <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">
                    <span class="bi bi-chevron-left"></span>
                  </a>
                </li>
                <li class="page-item next">
                  <a class="page-link" href="#">
                    <span class="bi bi-chevron-right"></span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </section><!-- End Property Grid Single-->

  </main><!-- End #main -->

<?php
    require 'inc/footer.php';
?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>