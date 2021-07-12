    <?php
        session_start();
        require '../../functions/functions.php';
        logged_only();

        $pdo = new PDO ('mysql:host=localhost;dbname=dashbord', 'root', '', [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        ]);
    
        if(!empty($_POST)) 
        {
        
            $img_name = $_FILES['appart_image']['name'];
            $img_size = $_FILES['appart_image']['size'];
            $tmp_name = $_FILES['appart_image']['tmp_name'];
            $error = $_FILES['appart_image']['error'];
        
            if ($error === 0) {
                if ($img_size > 125000) {
                    $_SESSION['flash']['danger'] = "Dimension non respecter";
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
                    $_SESSION['flash']['danger'] = "Dimension non respecter";
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
            }else{
                $_SESSION['flash']['danger'] = "Aucun plan de l'apparte";
                header("Location: index.php");
                exit();
            }
            
            $req = $pdo->prepare("INSERT INTO appartement SET nom=?, quatier=?, prix=?, chambre=?, douche=?, dimension=?, salon=?, adresse=?, image=?, emplacement=?, etat=?, caution=?, probleme=?, video=?, plan=?, description=?");
            $req ->execute([$_POST['name'], $_POST ['area'], $_POST ['price'], $_POST ['room'], $_POST ['bath'], $_POST ['dimension'], $_POST ['sitroom'], $_POST ['address'], $new_img_name, $_POST ['location'], $_POST ['helth'], $_POST ['caution'], $_POST ['problem'], $_POST ['video'], $new_plan_name, $_POST ['description']]);
            $_SESSION['flash']['success'] = "Appartement ajouté avec succès et est affiché directement sur RapidAppart. ";
            header('Location: index.php');
            exit();
        }

        $title = 'appartements';
        require '../inc/header.php';
    ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Appartements</h1>

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
        <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col">
                        <label for="nom">Nomination de l'appartement</label>
                        <input type="text" name="name" class="form-control" id="nom">
                    </div>

                    <div class="form-group col">
                        <label for="quatier">quatier où se trouve l'appartement</label>
                        <input type="text" name="area" class="form-control" id="quatier">
                    </div>

                    <div class="form-group col">
                        <label for="prix">Prix de l'appartement</label>
                        <input type="text" name="price" class="form-control" id="prix">
                    </div>
                </div>
            
                <div class="row">
                    <div class="form-group col">
                        <label for="chambre">Nombre de chambre dans l'appartement</label>
                        <input type="number" name="room" value="0" class="form-control" id="chambre">
                    </div>

                    <div class="form-group col">
                        <label>Nombre de douche dans l'appartement</label>
                        <input type="number" name="bath" value="0" class="form-control">
                    </div>

                    <div class="form-group col">
                        <label>Dimension de l'appartement</label>
                        <input type="text" name="dimension" class="form-control">
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col">
                        <label>Nombre de salon dans l'appartement</label>
                        <input type="number" name="sitroom" value="0" class="form-control">
                    </div>

                    <div class="form-group col">
                        <label>Adresse de l'appartement</label>
                        <input type="text" name="address" class="form-control">
                    </div>

                    <div class="form-group col">
                        <label>Images de l'appartement</label>
                        <input type="file" name="appart_image">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label>Emplacement de l'appartement</label>
                        <input type="text" name="location" class="form-control">
                    </div>

                    <div class="form-group col">
                        <label>Etat de l'appartement</label>
                        <input type="text" name="helth" class="form-control">
                    </div>

                    <div class="form-group col">
                        <label>Caution à payer sur l'appartement</label>
                        <input type="text" name="caution" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label>Problèmes de l'appartement</label>
                    <input type="text" name="problem" class="form-control">
                </div>

                <div class="form-group">
                    <label>Iframe de la vidéo de présentation de l'appartement</label>
                    <textarea type="text" name="video" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>Image du plan de l'appartement</label>
                    <input type="file" name="plan">
                </div>

                <div class="form-group">
                    <label>Description complète de l'appartement</label>
                    <textarea type="text" name="description" class="form-control" id="description"></textarea>
                </div>
                
                <button class="btn btn-primary text-center" onclick = "return confirm ('Vous êtes sûr de vouloir ajoute un appartement à ceux du bureau?')">Ajouter</button>
        </form>
  </div>
</div>
<script src="../../bootstrap/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace("description");
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../bootstrap/js/vendor/jquery.slim.min.js"><\/script>')</script>
<script src="../../bootstrap/dist/js/bootstrap.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="../dashboard.js"></script>
</body>
</html>