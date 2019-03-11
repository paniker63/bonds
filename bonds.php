<?php

require_once "simple_html_dom.php";

$url = 'http://en.boerse-frankfurt.de/bonds';

$html = file_get_html($url);

function getLinkfromborse($url){
    foreach ($html->find('col-lg-12') as $link_to_bonds){
	echo $link_to_bonds->href . PHP_EOL;
    }
}

//echo($html->innertext);
getLinkfromborse($url);

//var_dump("getLinkfromborse");
?>