<?php
session_start();
require '../compte/functions/functions.php';
logged_only();
?>
<?php
    $pdo = new PDO ('mysql:host=localhost;dbname=vndzklyp_bureau', 'vndzklyp_bureau', 'p!ixEnvb4Ug[', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
    ]);

    if(!empty($_POST))
    {
        $req = $pdo->prepare("INSERT INTO notif SET titre=?, contenu=?, lien=?");
        $req ->execute([$_POST['title'], $_POST ['content'], $_POST ['link']]);
        $job_id = $pdo->LastInsertId();
        $_SESSION['flash']['success'] = "Notification ajouté avec succès et est affiché directement sur CmaChmaX. ";
        header('Location: notification.php');
        exit();
    }

    require_once '../inc/header.php';
?>
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="../emplois/emplois.php">Emplois</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="notification.php">Notification</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../membres/m-ccx.php">Liste des inscrits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../site/contrat_h_web.php">Clients hebergement web</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../site/contrat_site.php">Clients site web</a>
          </li><br><br>
          
          
          <li class="nav-item">
            <a class="nav-link" href="../chatfuel/index.php">Chatbot_Chatfuel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../manychat/index.php">Chatbot_Manychat</a>
          </li><br><br>
          
          
          <li class="nav-item">
            <a class="nav-link" href="../dette/index.php">Les dettes de CmaChanX</a>
          </li>
        </ul>
      </div>
    </nav>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>Vous êtes sur le point d'ajouter une notification à ceux affichées sur CmaChanX</h3>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div><br><br>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
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
        <form action="" method="POST">
            <div class="row">
                <div class="form-group col">
                    <label for="name">Titre du notification</label>
                    <input type="text" name="title" class="form-control" id="name" required>
                </div>

                <div class="form-group col">
                    <label for="datetime">Lien</label>
                    <input type="text" name="link" class="form-control" id="datetime" required>
                </div>
            </div>

                <div class="form-group">
                    <label for="animator">Contenu</label>
                    <textarea type="text" name="content" class="form-control" id="animator" required></textarea>
                </div>
                <button class="btn btn-primary text-center" onclick = "return confirm ('Vous êtes sûr de vouloir ajouter de cette notification à ceux du bureau ?')">Ajouter</button>
        </form>
    </section>
  </div>
  <?php require_once '../inc/footer.php'; ?>