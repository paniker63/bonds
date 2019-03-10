<?php


// инициализация cURL
$ch = curl_init('https://www.etherchain.org/api/basic_stats');
// получать заголовки
curl_setopt ($ch, CURLOPT_HEADER, 0); 
// если ведется проверка HTTP User-agent, то передаем один из возможных допустимых вариантов:
curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3)Gecko/2008092417 Firefox/3.0.3');

// сохранять информацию Cookie в файл, чтобы потом можно было ее использовать
curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');

// возвращать результат работы
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
// не проверять SSL сертификат
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
// не проверять Host SSL сертификата
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);

// выполнить запрос
curl_exec ($ch);
// вывести результат
echo $result;
// закрыть сессию работы с cURL
curl_close ($ch);

$res=json_decode($result,true);
var_dump($ch);

?>