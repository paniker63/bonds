<?php


// инициализация cURL
$ch = curl_init('https://www.etherchain.org/api/basic_stats');
// получать заголовки
curl_setopt ($ch, CURLOPT_HEADER, 0); 
// если ведется проверка HTTP User-agent, то передаем один из возможных допустимых вариантов:
curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3');
// елси проверятся откуда пришел пользователь, то указываем допустимый заголовок HTTP Referer:
curl_setopt ($ch, CURLOPT_REFERER, 'https://'.$hostname.'/index.php');
// сохранять информацию Cookie в файл, чтобы потом можно было ее использовать
curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
// возвращать результат работы
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
// не проверять SSL сертификат
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
// не проверять Host SSL сертификата
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
// это необходимо, чтобы cURL не высылал заголовок на ожидание
curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Expect:'));
// выполнить запрос
curl_exec ($ch);
// получить результат работы
$result = curl_multi_getcontent ($ch);
// вывести результат
//echo ($result);
// закрыть сессию работы с cURL
curl_close ($ch);

$result=json_decode($result,true);


krsort($result['blocks']);
$block=file_get_contents('useblock');
foreach($result['blocks'] as $k=>$v){
	if($block<$v['number']){
		$sql="INSERT INTO blocks (id, miner, systemgentime, gentimestamp, blocktime) values ('".$v['number']."', '".$v['miner']."', '".$v['time']."', '".strtotime($v['time'])."', '".$v['blocktime']."')";
		var_dump($sql);
		file_put_contents('useblock',$v['number']);
	}
}

var_dump( $result['currentStats'];
var_dump( $result['blocks'] );

?>

select 
	round(gentimestamp/period) as period, 
	count(*) as kolvo
from blocks 
where gentimestamp>starttime
group by period

