    <?php
      session_start();
      require '../../functions/functions.php';
      logged_only();

      $title = 'reservation';
    
      require_once '../inc/header.php';
      require '../src/URLBuilder.php';
      require '../src/TableHelper.php';
      require '../src/PriceFormat.php';
    
      define('PER_PAGE', 10);
    
      $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '', [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
      ]);
    
    
    
      $query = "SELECT * FROM reservation";
      $listeCount = "SELECT COUNT(id) as count FROM reservation";
      $params = [];
    
      //Oganisation aussi
      $sortable = ["id", "nom", "prix", "caution", "emplacement", "message", "utilisateur", "resoud", "id_user"];
    
      //recherche par ville
      if(!empty($_GET['q'])){
        $query .= " WHERE nom LIKE :nom";
        $listeCount .= " WHERE nom LIKE :nom";
        $params['nom'] = '%'. $_GET['q'] . '%';
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
      
      $emploi = $pdo->prepare("SELECT * FROM reservation");
      $emploi->execute();
      $emplois = $emploi->rowCount('id');
    ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Il y a <?= $emplois; ?> réservation<?= ($emplois > 1)? 's' : '' ?> mis sur RapidAppart</h1>

      <div class="btn-toolbar mb-2 mb-md-0">
        <a href="addAppartement.php"><button class="btn btn-outline-primary">Ajouter un appartement</button></a>
      </div>
    </div>

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
              <input type="text" name="q" class="form-control" value="<?= htmlentities($_GET['q'] ?? null) ?>" placeholder="Recheche par nom de l'appartement">
          </div>
          <button class="btn btn-primary">Rechercher</button>
        </form>
      </div>

      
      <div class="card-body p-4">
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th><?= TableHelper::sort('id', 'N°', $_GET) ?></th>
              <th><?= TableHelper::sort('nom', "Nomination", $_GET) ?></th>
              <th><?= TableHelper::sort('prix', 'prix', $_GET) ?></th>
              <th><?= TableHelper::sort('emplacemment', 'Adresse', $_GET) ?></th>
              <th><?= TableHelper::sort('resoud', 'Déja traité ou pas', $_GET) ?></th>
              <th>Editer</th>
              <th>Sup</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach($listes as $liste): ?>
            <tr>
              <td>#<?= $liste['id']; ?></td>
              <td><?= $liste['nom']; ?></td>
              <td><?= $liste['prix']; ?></td>
              <td><?= $liste['emplacement']; ?></td>
              <td class="text-center"><?= $liste['resoud']; ?></td>
            <td>
            <a class="btn btn-outline-success" href="Editreservation.php?id=<?= $liste['id']; ?>"><i class="fas fa-edit"></i></a>
            </td>
            <td>
              <form action="code.php" method="post">
                <input type="hidden" name="delete_id" value="<?= $liste['id']; ?>">
                <button type="submit" class="btn btn-outline-danger" onclick = "return confirm ('Vous êtes sûr le point de supprimer l\'appartement n° <?= $liste['id']; ?>. Êtes-vous sûr de cette action?')"><i class="fas fa-trash-alt"></i></button>
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
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../bootstrap/js/vendor/jquery.slim.min.js"><\/script>')</script>
<script src="../../bootstrap/dist/js/bootstrap.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="../dashboard.js"></script>
</body>
</html>
