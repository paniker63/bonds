<?php

function get_content($url, $data = []){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,  true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,  true);
	//curl_setopt($ch, option: CURLOPT_POST, value: true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__.'/cookie.txt');
	curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__.'/cookie.txt');
	$res = curl_exec($ch);
	curl_close($ch);
	return $res;
}



$url = 'https://www.etherchain.org/api/basic_stats';

echo get_content($url);


?>