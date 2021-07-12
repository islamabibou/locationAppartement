<?php
session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['danger'] = "Vous êtes maintenant déconnecté. Vous pouvez vous reconnecter ci-dessous";
header('Location: ../index.php');