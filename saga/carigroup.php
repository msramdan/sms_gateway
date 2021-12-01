<?php


include "config/koneksi.php";

if(isset($_GET['q'])){
	$sql = "SELECT * FROM pbk_groups 
	WHERE NameGroup LIKE '%".$_GET['q']."%' order by NameGroup ASC
        LIMIT 10 "; 
}else{
	$sql = "SELECT * FROM pbk_groups"; 
}

$result = mysqli_query($mysqli,$sql);
$jum=mysqli_num_rows($result);
$json = [];
while($row = mysqli_fetch_assoc($result)){
       
            $json[] = ['id'=>$row['GroupID'], 'text'=>$row['NameGroup']];
    
}

echo json_encode($json);

?>