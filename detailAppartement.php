<?php
$pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '', [
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
]);

$id = $_GET['id'];
 
//selecting data associated with this particular id
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

$title = 'RapidAppart | Appartement';
require 'inc/header.php';
?>

  <main id="main">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="title-single-box">
              <h1 class="title-single"><?= $nom; ?></h1>
              <span class="color-text-a"><?= $quatier; ?></span>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Intro Single-->

    <!-- ======= Property Single ======= -->

    <section class="property-single nav-arrow-b">
      <div class="container">
      
      <div class="col-md-10 offset-md-1">
            <ul class="nav nav-pills-a nav-pills mb-3 section-t3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pills-video-tab" data-bs-toggle="pill" href="#pills-video" role="tab" aria-controls="pills-video" aria-selected="true">Vidéo de présentation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" href="#pills-plans" role="tab" aria-controls="pills-plans" aria-selected="false">Le plan de l'appartement</a>
              </li>
            </ul>
            <div class="tab-content">
              <div id="pills-video" class="tab-pane vid fade show active" role="tabpanel" aria-labelledby="pills-video-tab">
                <iframe src="https://www.youtube.com/embed/bI9ExOLqbzI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
              <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
                <img src="compto/rapidappart/appartement/img/plan/<?= $plan; ?>" alt="le plan de l'appartement" class="img-fluid">
              </div>
            </div>
          </div>

        <div class="row">
          <div class="col-sm-12">

            <div class="row justify-content-between">
              <div class="col-md-5 col-lg-4">
                <div class="property-summary">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="title-box-d section-t4">
                        <h3 class="title-d">Bon à savoir</h3>
                      </div>
                    </div>
                  </div>
                  <div class="summary-list">
                    <ul class="list">
                      <li class="d-flex justify-content-between">
                        <strong>Identifiant du bien:</strong>
                        <span>#<?= $id; ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Localisation:</strong>
                        <span><?= $adresse; ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Emplacement:</strong>
                        <span><?= $quatier; ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Prix :</strong>
                        <span><?= $prix; ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Dimension:</strong>
                        <span><?= $dimension; ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Douches :</strong>
                        <span><?= $douche; ?></span>
                      </li>
                      <li class="d-flex justify-content-between">
                        <strong>Etat :</strong>
                        <span><?= $etat; ?></span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-7 col-lg-7 section-md-t3">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="title-box-d">
                      <h3 class="title-d">Description de l'appartement</h3>
                    </div>
                  </div>
                </div>
                <div class="property-description">
                  <?= $description; ?>
                </div>
              </div>
            </div>
          </div>
            <div class="col-md-12 mt-3 text-center mt-5">
              <a href="reservation.php?id=<?= $id; ?>"><button class="btn btn-a">Réserver cet appartement</button></a>
            </div>
        </div>
      </div>
    </section><!-- End Property Single-->

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