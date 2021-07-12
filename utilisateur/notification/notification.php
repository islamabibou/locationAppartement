<?php
session_start();
require '../compte/functions/functions.php';
logged_only();
?>
<?php
  require_once '../inc/header.php';
  require '../src/URLBuilder.php';
  require '../src/TableHelper.php';
  require '../src/PriceFormat.php';

define('PER_PAGE', 10);
    $pdo = new PDO ('mysql:host=localhost;dbname=vndzklyp_bureau', 'vndzklyp_bureau', 'p!ixEnvb4Ug[', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
    ]);

    $query = "SELECT * FROM notif";
    $listeCount = "SELECT COUNT(id) as count FROM notif";
    $params = [];
    //Oganisation aussi
    $sortable = ["id", "titre", "contenu", "lien"];

//recherche par ville
    if(!empty($_GET['q'])){
        $query .= " WHERE titre LIKE :titre";
        $listeCount .= " WHERE titre LIKE :titre";
        $params['titre'] = '%'. $_GET['q'] . '%';
    }

//Organisation
if(!empty($_GET['sort']) && in_array($_GET['sort'], $sortable)){
    $direction = $_GET['dir'] ?? 'asc';
    if(in_array($direction, ['asc', 'desc'])){
        $direction = 'asc';
    }
    $query .= "ORDER BY " . $_GET['sort'] . " $direction";
}


//la pagination
$numeropage = (int)($_GET['p'] ?? 1);
$offset = ($numeropage-1) * PER_PAGE;
$query .= " LIMIT " . PER_PAGE . " OFFSET $offset";

$statement = $pdo->prepare($query);
$statement->execute($params);
$listes = $statement->fetchAll();

$statement = $pdo->prepare($listeCount);
$statement->execute($params);
$count = (int)$statement->fetch()['count'];
$pages = ceil($count / PER_PAGE);

$notif = $pdo->prepare("SELECT * FROM notif");
$notif->execute();
$notifs = $notif->rowCount('id');


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
    <h1 class="h2">Liste des notifications affichés sur CmaChanX = <?= $notifs ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="add_notification.php"><button class="btn btn-outline-primary">Ajouter une notification</button></a>
    </div>
  </div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
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
        <div class="card-header">
        <form action="">
          <form action="" class="mt-4">
          <div class="form-group">
              <input type="text" name="q" class="form-control" value="<?= htmlentities($_GET['q'] ?? null) ?>" placeholder="Recheche par nom du notification">
          </div>
          <button class="btn btn-primary">Rechercher</button>
          </form>
        </div>

        <div class="card-body p-4">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 5%"><?= TableHelper::sort('id', 'N°', $_GET) ?></th>
                      <th style="width: 15%"><?= TableHelper::sort('titre', "Titre", $_GET) ?></th>
                      <th style="width: 60%"><?= TableHelper::sort('contenu', 'Contenu', $_GET) ?></th>
                      <th style="width: 30%"><?= TableHelper::sort('lien', 'Lien', $_GET) ?></th>
                  </tr>
              </thead>
              <tbody>
                <?php foreach($listes as $liste): ?>
                  <tr>
                      <td>#<?= $liste['id']; ?></td>

                      <td><?= $liste['titre']; ?></td>

                      <td class="project-progress"><?= $liste['contenu']; ?></td>

                      <td class="project-progress"><?= $liste['lien']; ?></td>

                      <td>
                        <form action="code.php" method="post">
                          <input type="hidden" name="delete_id" value="<?= $liste['id']; ?>">
                          <button type="submit" class="btn btn-outline-danger" onclick = "return confirm ('Vous êtes sûr le point de supprimer la notification n° <?= $liste['id']; ?>. Êtes-vous sûr de cette action?')">Supprimer</button>
                        </form>
                     </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
          </table>

          <?php if($pages > 1 && $numeropage > 1): ?>
              <a href="?<?= URLBuilder::urlconstruct($_GET, "p", $numeropage - 1) ?>" class="btn btn-primary">Page précédente</a>
          <?php endif ?>
          <?php if($pages > 1 && $numeropage < $pages): ?>
              <a href="?<?= URLBuilder::urlconstruct($_GET, "p", $numeropage + 1) ?>" class="btn btn-primary">Page suivante</a>
          <?php endif ?>
        </div>
      </div>
    </section>
  </div>
  <?php require_once '../inc/footer.php'; ?>