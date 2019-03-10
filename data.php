<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

$db_host        = 'localhost';
$db_user        = 'root';
$db_pass        = 'gfybrth6';
$db_database    = 'block_scanner'; 
/* End config */
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_database);
/* check connection */
if (mysqli_connect_errno()) {printf("Connect failed: %s\n", mysqli_connect_error());}

	
    $query= "
      select 
        round(gentimestamp/1800) as gengroup,
        FROM_UNIXTIME(min(gentimestamp)) as gentime2,
        count(*) as kolvo,
        avg(blocktime) as avgtime
        from blocks 
        where systimegentime>'2019-02-25'
        group by gengroup
        order by 1 desc
    ";
 

    $result = mysqli_query($mysqli, $query);
    
    
    if (!$result) die ("Database access failed:" . mysql_error());

?> 

<table border="ridge" class="table_blur">
    <tr class="header">
        <td>gengroup</td>
        <td>kolvo</td>
        <td>kolvo</td>
        <td>avgtime</td>
    </tr>
    <?php
       while ($row = mysqli_fetch_array($result)) {
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




