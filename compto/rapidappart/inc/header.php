<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Administration de RapidAppart</title>
    
	  <link rel="icon" type="image/png" href="../../bootstrap/img/richard.png"/>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS -->
<link href="../../bootstrap/dist/css/bootstrap.css" rel="stylesheet">
  
  <!-- font awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow">
  <span class="navbar-brand col-md-3 col-lg-2 mr-0 px-3"><?= $_SESSION['auth']->email; ?></span>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a href="../../forget.php"><div class="btn btn-light mr-2">Mot de passe oublié</div></a>
      <a href="../../logout.php"><div class="btn btn-light">Se deconnecté</div></a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?= ($title === 'appartements') ? 'active' : ''?>" href="../appartement/index.php">
              <span data-feather="home"></span>
              Appartements
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Immeubles à vendre
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link <?= ($title === 'reservation') ? 'active' : ''?>" href="../reservation/index.php">
              <span data-feather="home"></span>
              Réservations
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link <?= ($title === '') ? 'active' : ''?>" href="index.php">
              <span data-feather="home"></span>
              Plaintes
            </a>
          </li>
        </ul>
      </div>
    </nav>