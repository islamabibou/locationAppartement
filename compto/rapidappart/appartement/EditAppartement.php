<?php
    session_start();

    $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
    ]);

    if(isset($_POST{'update'}) && isset($_FILES['appart_image']) && isset($_FILES['plan'])){
    
        $img_name = $_FILES['appart_image']['name'];
        $img_size = $_FILES['appart_image']['size'];
        $tmp_name = $_FILES['appart_image']['tmp_name'];
        $error = $_FILES['appart_image']['error'];
    
        if ($error === 0) {
            
            if ($img_size > 125000) {
                $_SESSION['flash']['danger'] = "Dimension apparte non respecter";
                header("Location: index.php");
                exit();
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png"); 
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'img/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                }else {
                    $_SESSION['flash']['danger'] = "Extensions d'image d'appartement non prise en compte";
                    header("Location: index.php");
                    exit();
                }
            }
        }else {
            $_SESSION['flash']['danger'] = "Aucune image n'a été uploader pour l'apparte";
            header("Location: index.php");
            exit();
        }
        
            $plan_name = $_FILES['plan']['name'];
            $plan_size = $_FILES['plan']['size'];
            $plan_tmp_name = $_FILES['plan']['tmp_name'];
            $plan_error = $_FILES['plan']['error'];
        
            if ($plan_error === 0) {
                if ($plan_size > 125000) {
                    $_SESSION['flash']['danger'] = "Dimension plan non respecter";
                    header("Location: index.php");
                    exit();
                }else {
                    $plan_ex = pathinfo($plan_name, PATHINFO_EXTENSION);
                    $plan_ex_lc = strtolower($plan_ex);
        
                    $plan_allowed_exs = array("jpg", "jpeg", "png"); 
        
                    if (in_array($plan_ex_lc, $plan_allowed_exs)) {
                        $new_plan_name = uniqid("PLAN-", true).'.'.$plan_ex_lc;
                        $plan_upload_path = 'img/plan/'.$new_plan_name;
                        move_uploaded_file($plan_tmp_name, $plan_upload_path);
                    }else {
                        $_SESSION['flash']['danger'] = "Type d'image d'appartement non prise en compte";
                        header("Location: index.php");
                        exit();
                    }
                }
            }else {
                $_SESSION['flash']['danger'] = "Aucun plan de l'apparte";
                header("Location: index.php");
                exit();
            }

        $id = $_GET['id'];

        $req = $pdo->prepare("UPDATE appartement SET nom=?, quatier=?, prix=?, chambre=?, douche=?, dimension=?, salon=?, adresse=?, image=?, emplacement=?, etat=?, caution=?, probleme=?, video=?, plan=?, description=? WHERE id=?");
        $req ->execute([$_POST['name'], $_POST ['area'], $_POST ['price'], $_POST ['room'], $_POST ['bath'], $_POST ['dimension'], $_POST ['sitroom'], $_POST ['address'], $new_img_name, $_POST ['location'], $_POST ['helth'], $_POST ['caution'], $_POST ['problem'], $_POST ['video'], $new_plan_name, $_POST ['description'], $id]);
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
        <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col">
                        <label for="nom">Nomination de l'appartement</label>
                        <input type="text" name="name" class="form-control" id="nom" value="<?= $nom; ?>">
                    </div>

                    <div class="form-group col">
                        <label for="quatier">quatier où se trouve l'appartement</label>
                        <input type="text" name="area" class="form-control" id="quatier" value="<?= $quatier; ?>">
                    </div>

                    <div class="form-group col">
                        <label for="prix">Prix de l'appartement</label>
                        <input type="text" name="price" class="form-control" id="prix" value="<?= $prix; ?>">
                    </div>
                </div>
            
                <div class="row">
                    <div class="form-group col">
                        <label for="chambre">Nombre de chambre dans l'appartement</label>
                        <input type="number" name="room" class="form-control" id="chambre" value="<?= $chambre; ?>">
                    </div>

                    <div class="form-group col">
                        <label>Nombre de douche dans l'appartement</label>
                        <input type="number" name="bath" class="form-control" value="<?= $douche; ?>">
                    </div>

                    <div class="form-group col">
                        <label>Dimension de l'appartement</label>
                        <input type="text" name="dimension" class="form-control" value="<?= $dimension; ?>">
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col">
                        <label>Nombre de salon dans l'appartement</label>
                        <input type="number" name="sitroom" class="form-control" value="<?= $salon; ?>">
                    </div>

                    <div class="form-group col">
                        <label>Adresse de l'appartement</label>
                        <input type="text" name="address" class="form-control" value="<?= $adresse; ?>">
                    </div>

                    <div class="form-group col">
                        <label>Images de l'appartement</label>
                        <input type="file" name="appart_image">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label>Emplacement de l'appartement</label>
                        <input type="text" name="location" class="form-control" value="<?= $emplacement; ?>">
                    </div>

                    <div class="form-group col">
                        <label>Etat de l'appartement</label>
                        <input type="text" name="helth" class="form-control" value="<?= $etat; ?>">
                    </div>

                    <div class="form-group col">
                        <label>Caution à payer sur l'appartement</label>
                        <input type="text" name="caution" class="form-control" value="<?= $caution; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Problèmes de l'appartement</label>
                    <input type="text" name="problem" class="form-control" value="<?= $probleme; ?>">
                </div>

                <div class="form-group">
                    <label>Iframe de la vidéo de présentation de l'appartement</label>
                    <textarea type="text" name="video" class="form-control"><?= $video; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Image du plan de l'appartement</label>
                    <input type="file" name="plan">
                </div>

                <div class="form-group">
                    <label>Description complète de l'appartement</label>
                    <textarea type="text" name="description" class="form-control" id="description"><?= $dimension; ?></textarea>
                </div>
                
                <button type="submit" name="update" class="btn btn-success text-center" onclick = "return confirm ('Vous êtes sûr de vouloir modifier les infos de cet appartement ?')">Modifier</button>
        </form>
    </section>
    
<script src="../../bootstrap/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace("description");
</script>