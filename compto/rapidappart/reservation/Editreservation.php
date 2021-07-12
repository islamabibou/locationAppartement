<?php
    session_start();

    $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
    ]);

    if(isset($_POST{'update'})){

        $id = $_GET['id'];

        $req = $pdo->prepare("UPDATE reservation SET nom=?, prix=?, caution=?, emplacement=?, message=?, utilisateur=?, resoud=?, id_user=? WHERE id=?");
        $req ->execute([$_POST['name'], $_POST ['price'], $_POST ['caution'], $_POST ['emplacement'], $_POST ['comment'], $_POST ['user'], $_POST ['resolv'], $_POST ['id_user'], $id]);
        $_SESSION['flash']['success'] = "L'apparte a bien été modif!";

        header('Location: index.php');

        exit();
    }

    $title = 'emplois';
    require_once '../inc/header.php';
?>
<?php

$id = $_GET['id'];
 
//selecting data associated with this particular id
$req = $pdo->prepare("SELECT * FROM reservation WHERE id=:id");
$req ->execute(array(':id' => $id));
 
while($entrees = $req->fetch(PDO::FETCH_ASSOC))
{
    $id = $entrees['id'];
    $nom = $entrees['nom'];
    $prix = $entrees['prix'];
    $caution = $entrees['caution'];
    $emplacement = $entrees['emplacement'];
    $message = $entrees['message'];
    $utilisateur = $entrees['utilisateur'];
    $resoud = $entrees['resoud'];
    $id_user = $entrees['id_user'];
}
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

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

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>Modification d'élement</h3>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div><br><br>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <form action="" method="POST">
                <div class="row">
                    <div class="form-group col">
                        <label for="nom">Nomination de l'appartement</label>
                        <input type="text" name="name" class="form-control" id="nom" value="<?= $nom; ?>">
                    </div>

                    <div class="form-group col">
                        <label for="quatier">Prix de l'appartement</label>
                        <input type="text" name="price" class="form-control" id="quatier" value="<?= $prix; ?>">
                    </div>
                </div>
            
                <div class="row">
                    <div class="form-group col">
                        <label for="chambre">Caution de l'appartement</label>
                        <input type="text" name="caution" class="form-control" id="chambre" value="<?= $caution; ?>">
                    </div>

                    <div class="form-group col">
                        <label>Emplacement de l'appartement</label>
                        <input type="text" name="emplacement" class="form-control" value="<?= $emplacement; ?>">
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col">
                        <label>Courriel de l'utilisateur</label>
                        <input type="text" name="user" class="form-control" value="<?= $utilisateur; ?>">
                    </div>

                    <div class="form-group col">
                        <label>Traitement</label>
                        <select type="text" name="resolv" class="form-control" value="<?= $resoud ?>">
                            <option value="<i class='fas fa-times text-danger'></i>">non</option>
                            <option value="<i class='fas fa-check text-success'></i>">déjà</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Identifiant de l'utilisateur</label>
                    <input type="text" name="id_user" class="form-control" value="<?= $id_user; ?>">
                </div>

                <div class="form-group">
                    <label>Message</label>
                    <textarea type="text" name="comment" class="form-control" id="description"><?= $message; ?></textarea>
                </div>
                
                <button type="submit" name="update" class="btn btn-success text-center" onclick = "return confirm ('Vous êtes sûr de vouloir modifier les infos de cet appartement ?')">Modifier</button>
        </form>
    </section>
    
<script src="../../bootstrap/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace("description");
</script>