<?php

$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
$intro = trim(filter_var($_POST['intro'], FILTER_SANITIZE_STRING));
$text = trim(filter_var($_POST['text'], FILTER_SANITIZE_STRING));




$error = '';
if(strlen($title) <= 3)
    $error = 'Input title';
else if(strlen($intro) <= 15)
    $error = 'Input intro';
else if(strlen($text) <= 20)
    $error = 'Input text';

if($error != '') {
    echo $error;
    exit();
}

require '../mysql_connection.php';

$sql = 'INSERT INTO articles(title, intro, text, data, author) VALUES(?, ?, ?, ?, ?)';

$query = $pdo->prepare($sql);
$query->execute([$title, $intro, $text, time(), $_COOKIE['log']]);

echo 'Ready';

?>
