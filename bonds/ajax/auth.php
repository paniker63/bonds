<?php 

$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
$pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

$error = '';
if(strlen($login) <=3)
	$error = 'Input login';
else if(strlen($pass) <=3)
	$error = 'Input password';
	
if($error != '') {
	echo $error;
	exit();
}

$hash = "gddfsgsdfh34gdsfgdf";
$pass = md5($pass . $hash);

require_once '../mysql_connection.php';

$sql = 'SELECT id FROM users WHERE login = :login AND pass = :pass';

$query = $pdo->prepare($sql);
$query->execute(['login' => $login, 'pass' => $pass]);

$user = $query->fetch(PDO::FETCH_OBJ);
if($user->id == 0)
	echo 'No such user';
else {
	setcookie('log', $login, time() + 3600 * 24 * 30, "/bonds");
	echo 'Ready';
} 



?>
