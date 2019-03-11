<html>
<head>


 <title>Xyu</title>


</head>
</html>


<?php

//header('Content_type: text/html; charset=utf-8');

//$url_auth = '';
//$url = 'https://www.etherchain.org/api/basic_stats';


function get_content($url, $data = []){
	$ch = curl_init($url);
	curl_setopt ($ch, CURLOPT_HEADER, 0);
// если ведется проверка HTTP User-agent, то передаем один из возможных допустимых вариантов:
	curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3');
// елси проверятся откуда пришел пользователь, то указываем допустимый заголовок HTTP Referer:
	//curl_setopt ($ch, CURLOPT_REFERER, 'https://'.$hostname.'/index.php');
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

	return $result;

}

	//connect to mysql db
    $con = mysqli_connect('localhost',"root","gfybrth6","block_scanner") or die('Could not connect: ' . mysqli_error($con));
    //connect to the database
    //mysql_select_db("block_scanner", $con);

file_put_contents(dirname(__FILE__).'/log.log',date("Y-m-d H:i:s")."\n",FILE_APPEND);
for($x=0;$x<4;$x++){
$result=get_content('https://www.etherchain.org/api/basic_stats');
$result=json_decode($result,true);
//var_dump($result);
krsort($result['blocks']);
$block=file_get_contents(dirname(__FILE__).'/useblock');
foreach($result['blocks'] as $k=>$v){
	if($block<$v['number']){
		$sql="INSERT INTO blocks (id, miner, systimegentime, gentimestamp, blocktime) values ('".$v['number']."', '".$v['miner']."', '".$v['time']."', '".strtotime($v['time'])."', '".$v['blocktime']."')";
		if(!mysqli_query($con,$sql))
    {
        die('Error : ' . mysqli_error($con));
    }

		file_put_contents(dirname(__FILE__).'/useblock',$v['number']);
	}
}
sleep(10);
}

 $query= "
     select
        round(gentimestamp/1800) as gengroup,
        FROM_UNIXTIME(min(gentimestamp)) as gentime2,
        count(*) as kolvo,
        avg(blocktime) as avgtime
        from blocks
        where systimegentime>'2019-02-11'
        group by gengroup
        order by 1 desc

      ";


    $result = mysqli_query($query);


    if (!$result) die ("Database access failed:" . mysqli_error());

  #  echo '<pre>';
  #  print_r($result);
  #  echo'</pre>';

?>

<table border="ridge" class="table_blur">
    <tr class="header">
        <td>gengroup</td>
        <td>gentime2</td>
        <td>kolvo</td>
        <td>avgtime</td>

    </tr>
    <?php
       while ($row = mysql_fetch_array($result)) {
           echo "<tr>";
           echo "<td>".$row['gengroup']."</td>";
           echo "<td>".$row['gentime2']."</td>";
           echo "<td>".$row['kolvo']."</td>";
           echo "<td>".$row['avgtime']."</td>";
           echo "</tr>";
       }

    ?>
</table>


</body>

</html>


?>
<!--

select
round(gentimestamp/86400) as gengroup,
FROM_UNIXTIME(min(gentimestamp)) as gentime2,
count(*) as kolvo,
avg(blocktime) as avgtime
from blocks
where systimegentime>'2018-12-01'
group by gengroup
order by 1 desc

-->
