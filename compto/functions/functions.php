<?php
function debug($variable){
	echo '<pre>' . print_r($variable, true) . '</pre>';
}

function str_random($length){
	$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXVBN";
	return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

function logged_only(){
if(!isset($_SESSION['auth'])){
	$_SESSION['flash']['danger'] = "Impossible d'accéder à la page appelée sans que vous n'ayez un compte au préalable. <a href='register.php';>Cliquer ici</a> pour en ouvrir et si c'est fait, <a href='login.php';>Connectez-vous ici</a> !";
	header('Location: ../compto/login.php');
    exit();
}
}

/* function reconnect_from_cookie(){
	
if(isset($_COOKIE['remember'])){
	require_once 'bdd/db.php';
	$remember_token = $_COOKIE['remember'];
	$parts = explode('==', $remember_token);
	$user_id = $parts[0];
	$req = $pdo->prepare('SELECT * FROM compte WHERE id = ?');
	$user = $req->fetch();
	if($user){
		$user_id . '==' . $user->remember_token . sha1($user_id . 'jfal162o!8evacCCX');
		if($expected == $remember_token){
			session_start();
    		$_SESSION['auth'] = $user;
			header('Location: account.php');
		}
	}
}
} */