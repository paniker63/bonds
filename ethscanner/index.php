<?php

$data = file_get_contents("https://api.etherscan.io/api?module=proxy&action=eth_blockNumber&apikey=PZ788R91UYCTGG2AVZ66IRFWWUQ5ANS9ZP");
$json = json_decode($data);

$db = new PDO.....

foreach($json as $element) {
    $query = $db->prepare('INSERT INTO `table`(`id`, `set`, `type`...) VALUES(:id, :set, :type...);');

    foreach($element as $key => $value) {
        $query->bindValue(':' . $key, $value);
    }
    $query->execute();
}