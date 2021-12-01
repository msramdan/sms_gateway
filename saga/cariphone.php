<?php


include "config/koneksi.php";

if(isset($_GET['q'])){
	$sql = "SELECT Name,Number from pbk
        WHERE Name LIKE '%".$_GET['q']."%' or Number LIKE '%".$_GET['q']."%' order by Name ASC
        LIMIT 10"; 
}else{
	$sql = "SELECT Name,Number from pbk order by Name ASC LIMIT 20"; 
}

$result = mysqli_query($mysqli,$sql);
$jum=mysqli_num_rows($result);
$json = [];
while($row = mysqli_fetch_assoc($result)){
       
            $json[] = ['id'=>$row['Number'], 'text'=>$row['Name']];
    
     

}

echo json_encode($json);

?>