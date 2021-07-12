<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?? 'RapidAppart' ?></title>
  <meta content="description" name="RapidAppart est une agence immobilière sise à Dakar qui vous garantir aux désireux un appartement sur mesure">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
  <!-- font awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>

<body>
  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top" style="font-size: 12px">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.php">Rapid<span class="color-b">Appart</span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link <?= ($title === 'RapidAppart | Accueil') ? 'active' : ''?>" href="index.php">Accueil</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?= ($title === 'RapidAppart | appartement') ? 'active' : ''?>" href="appartement.php">Appartements</a>
          </li>
      
          <li class="nav-item">
            <a class="nav-link <?= ($title === 'RapidAppart | a_vendre') ? 'active' : ''?>" href="a_vendre.php">Immeubles</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Autres services</a>
            <div class="dropdown-menu">
              <a class="dropdown-item " href="https://cmachanx.com/h_web/site.php" target="_blank">Création de site internet</a>
              <a class="dropdown-item " href="https://cmachanx.com/h_web/chatbot.php" target="_blank">Création de robots messenger (Facebook)</a>
              <a class="dropdown-item " href="https://cmachanx.com/h_web/index.php" target="_blank">Hébergement de site web</a>
              <a class="dropdown-item " href="https://cmachanx.com/h_web/dns.php" target="_blank">Réservation/Achat de nom de domaine</a>
              <a class="dropdown-item " href="https://cmachanx.com/h_web/fb.php" target="_blank">Faire connaitre votre activité (entreprise) en ligne</a>
            </div>
          </li>
          <?php if(isset($_SESSION['auth'])): ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-success" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>
            <div class="dropdown-menu">
              <a class="dropdown-item " href="plaintes.php">Déposer une plainte/ ticket</a>
              <?php
                $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '', [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
                ]);
                $id_user = $_SESSION['auth']->id_user;
                $emploi = $pdo->prepare("SELECT * FROM plaintes WHERE id_user = $id_user");
                $emploi->execute();
                $emplois = $emploi->rowCount('id_user');

                $id_user = $_SESSION['auth']->id_user;
                $reserve = $pdo->prepare("SELECT * FROM reservation WHERE id_user = $id_user");
                $reserve->execute();
                $reserves = $reserve->rowCount('id_user');
              ?>
              <a class="dropdown-item " href="les_plaintes.php">Mes plaintes <sup class="text-success">0<?= $emplois ?></sup></a>
              <a class="dropdown-item " href="les_reservations.php">Mes réservations <sup class="text-success">0<?= $reserves ?></sup></a>
              <a class="dropdown-item " href="#">Faire une location spéciale de voiture</a>
              <a class="dropdown-item " href="#">Mes locations spéciale de voiture</a>
              <a class="dropdown-item " href="https://cmachanx.com/h_web/site.php" target="_blank">Commander la création de site internet</a>
              <a class="dropdown-item " href="https://cmachanx.com/h_web/index.php" target="_blank">Hébergement de site web</a>
              <a class="dropdown-item " href="https://cmachanx.com/h_web/dns.php" target="_blank">Réservation/ Achat de nom de domaine</a>
              <a class="dropdown-item " href="https://cmachanx.com/h_web/fb.php" target="_blank">Faire connaitre votre activité (entreprise) en ligne [agence web]</a>
              <a class="dropdown-item " href="utilisateur/logout.php">Se déconnecter</a>
              <a class="dropdown-item " href="utilisateur/forget.php">Mot de passe oublié!</a>
            </div>
          </li>
        <?php endif; ?>

          <li class="nav-item">
            <a class="nav-link <?= ($title === 'RapidAppart | contact') ? 'active' : ''?>" href="contact.php">Contact</a>
          </li>

          <p class="intro-subtitle intro-price" style="margin: 15px 0 0 20px;">
          <?php if(isset($_SESSION['auth'])): ?>
            <a href="utilisateur/logout.php"><span class="price-a" style="color: #000;">Déconnexion</span></a>
          <?php else: ?>
            <a href="utilisateur/login.php"><span class="price-a" style="color: #000;">Connexion</span></a>
            <a href="utilisateur/register.php"><span class="price-a" style="color: #000;">S'inscrire</span></a>
          <?php endif; ?>
          </p>
        </ul>
      </ul>
      </div>

    </div>
  </nav><!-- End Header/Navbar -->