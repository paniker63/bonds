<?php 

$user = 'root';
$password = 'gfybrth6';
$db = 'bond';
$host = 'localhost';

$dsn = 'mysql:host='.$host.';dbname='.$db;
$pdo = new PDO($dsn, $user, $password);




?>