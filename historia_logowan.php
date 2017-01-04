<a href='index_z7.php'>Wróć.</a><br><br>
<?php
require_once 'db_connection.php'; //Łączenie z bazą.

	$user=$_COOKIE['Login'];
	$sql4 = mysql_query("SELECT * FROM logi WHERE log_user='$user' ORDER BY log_id DESC");
	if(mysql_num_rows($sql4) > 0) { 
   
    echo "<table cellpadding=\"3\" border=1> 
	<tr>
	<th>log_ip</th>
	<th>log_godz</th>
	<th>log_status</th>
	<th>log_user</th>
	</tr>";
	
    while($r = mysql_fetch_assoc($sql4)) { 
        echo "<tr>"; 
        echo "<td>".$r['log_ip']."</td>"; 
        echo "<td>".$r['log_godz']."</td>"; 
		echo "<td>".$r['log_status']."</td>";
		echo "<td>".$r['log_user']."</td>";      
    }
	echo "</table>";
		}
?>

