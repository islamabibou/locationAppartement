<?php
session_start();
$user_id = $_GET['id'];
$token = $_GET['token'];
require 'bdd/db.php';
$req = $pdo->prepare('SELECT confirmation_token FROM compte WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();

if($user && $user->confirmation_token == $token)
{
	$pdo->prepare('UPDATE compte SET confirmation_token=NULL, confirmed_at=NOW() WHERE id=?')->execute(array($user_id));
	$_SESSION['auth'] = $user;
	$_SESSION['flash']['success'] = "Bravo, la confirmaton de votre compte s'est passée avec succès. A présent, connectez-vous pour continuer!";
	header('Location: login.php');
}else{
	$_SESSION['flash']['danger'] = "Ce lien est déjà utilisé ou est erroné";
	header('Location: login.php');
}