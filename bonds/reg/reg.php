<?php 

$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
$pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));



$error = '';
if(strlen($username) <= 3)
	$error = 'Input Name';
else if(strlen($email) <=3)
	$error = 'Input Email';
else if(strlen($login) <=3)
	$error = 'Input login';
else if(strlen($pass) <=3)
	$error = 'Input password';
	
if($error != '') {
	echo $error;
	exit();
}

$hash = "gddfsgsdfh34gdsfgdf";
$pass = md5($pass . $hash);

$user = 'root';
$password = 'gfybrth6';
$db = 'bond';
$host = 'localhost';

$dsn = 'mysql:host='.$host.';dbname='.$db;
$pdo = new PDO($dsn, $user, $password);


$sql = 'INSERT INTO users(name, email, login, pass) VALUES(?, ?, ?, ?)';

$query = $pdo->prepare($sql);
$query->execute([$username, $email, $login, $pass]);

echo 'Готово';



?>