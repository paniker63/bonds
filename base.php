<!DOCTYPE html>

<!DOCTYPE html>

<html>
<head>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>

	<title>baza</title>


</head>
<body>
	 <style>
		.table_blur {
  background: #f5ffff;
  border-collapse: collapse;
  text-align: left;
}
.table_blur th {
  border-top: 1px solid #777777;	
  border-bottom: 1px solid #777777; 
  box-shadow: inset 0 1px 0 #999999, inset 0 -1px 0 #999999;
  background: linear-gradient(#9595b6, #5a567f);
  color: white;
  padding: 10px 15px;
  position: relative;
}
.table_blur th:after {
  content: "";
  display: block;
  position: absolute;
  left: 0;
  top: 25%;
  height: 25%;
  width: 100%;
  background: linear-gradient(rgba(255, 255, 255, 0), rgba(255,255,255,.08));
}
.table_blur tr:nth-child(odd) {
  background: #ebf3f9;
}
.table_blur th:first-child {
  border-left: 1px solid #777777;	
  border-bottom:  1px solid #777777;
  box-shadow: inset 1px 1px 0 #999999, inset 0 -1px 0 #999999;
}
.table_blur th:last-child {
  border-right: 1px solid #777777;
  border-bottom:  1px solid #777777;
  box-shadow: inset -1px 1px 0 #999999, inset 0 -1px 0 #999999;
}
.table_blur td {
  border: 1px solid #e3eef7;
  padding: 10px 15px;
  position: relative;
  transition: all 0.5s ease;
}

	 </style>
   <?php

$db_hostname = "localhost";
$db_username = "root";
$db_password = "gfybrth6";
$db_database = "block_scanner";

$dcxn = mysqli_connect('localhost',"root","gfybrth6","block_scanner") or die('Could not connect: ' . mysqli_error($con));


    $selection = $_POST["GenreSel"];
	  mysqli_query("set names 'utf8'");
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




</body>
</html>

