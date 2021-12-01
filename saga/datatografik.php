<?php
include "config/koneksi.php";


	
		if(isset($_GET['all'])){
			$result = mysqli_query($mysqli,"SELECT * FROM tbl_polling");

			$rows = array();
			while($r = mysqli_fetch_array($result)) {


			    $name= $r[1];
			    $jumlah = $r[2];


			  	$unit['data'][] = $name;
		   		$rows['data'][] = $jumlah;	
			}
			$rslt = array();

		array_push($rslt, $unit);
		array_push($rslt, $rows);
		print json_encode($rslt, JSON_NUMERIC_CHECK);

		}

		





?>
	
		