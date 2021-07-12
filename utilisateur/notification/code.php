<?php
    session_start();
    $pdo = new PDO ('mysql:host=localhost;dbname=vndzklyp_bureau', 'vndzklyp_bureau', 'p!ixEnvb4Ug[', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
    ]);

    if(!empty($_POST))
    {
        $req = $pdo->prepare("DELETE FROM notif WHERE id = ?");
        $req ->execute([$_POST['delete_id']]);
        $event_id = $pdo->LastInsertId();
        $_SESSION['flash']['success'] = "La notification a bien été supprimer!";
        header('Location: notification.php');
        exit();
    }else
    {
            $_SESSION['danger'] = "Echec";
            header('Location: notification.php');
    }
?>