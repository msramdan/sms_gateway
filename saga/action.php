<?php
if (isset($_POST['input'])) {

	  $pesan=$_POST['pesan'];

	foreach ($_POST['nohp'] as $nohp){
      $jmlSMS=ceil(strlen($pesan)/153);
	  $pecah=str_split($pesan, 153);
	  $hasil=mysqli_query($mysqli,"SHOW TABLE STATUS LIKE 'outbox'");
	  $data=mysqli_fetch_array($hasil);
	  $newID=$data['Auto_increment'];
	  for ($i=1; $i<=$jmlSMS; $i++)
	  {
		  $udh="050003A7".sprintf("%02s",$jmlSMS).sprintf("%02s",$i);
		  
		  $msg=$pecah[$i-1];
		  if($i == 1){
			  $sql = mysqli_query($mysqli,"INSERT INTO outbox(DestinationNumber,UDH,TextDecoded,ID,Multipart,CreatorID) VALUES
			  ('$nohp','$udh','$msg','$newID','true','Gammu')");
			  if ($sql > 0) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Kirim<br/></div>";
				} else {
					echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
				}
		  }else {
			   $sql = mysqli_query($mysqli,"INSERT INTO outbox_multipart(UDH,TextDecoded,ID,SequencePosition) VALUES
			  ('$udh','$msg','$newID','$i')");
			  if ($sql > 0) {
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Kirim<br/></div>";
				} else {
					echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
				} 
		  }
	  	}
	  }

	  

                 
           
}

if (isset($_POST['inputgroup'])) {
  $message = $_POST['pesan'];
  foreach ($_POST['group'] as $group){
      $query = mysqli_query($mysqli, "SELECT * FROM pbk WHERE GroupID='".$group."'");
    while ($row = mysqli_fetch_array($query)) {
        $query2 = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('" . $row['Number'] . "', '$message', 'Gammu')";
        $hasil = mysqli_query($mysqli,$query2);

        if ($hasil > 0) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Kirim ke no " . $row['Number'] . "<br/></div>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
        }

    }
  }  
  
  

}

if (isset($_POST['cekpulsa'])) {
	$number=$_POST['nopulsa'];
					// jalankan perintah cek pulsa via gammu
  		exec("c:\C:\gammu -c c:\C:\gammu\bin\gammuurc getussd ".$number."", $hasil);

  					// proses filter hasil output
  			for ($i=0; $i<=count($hasil)-1; $i++)
  				{
  					if (substr_count($hasil[$i], 'Service reply') > 0)$index = $i;
  			  }
					// menampilkan sisa pulsa
				echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> $hasil[$i] </strong> $number </div>" ;
}

if (isset($_POST['inputfilter'])) {
  	$bagianWhere = "";

   	if (isset($_POST['cekjab'])) {
        $idjab = $_POST['idjab2'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "idjab='$idjab'";
        } else {
            $bagianWhere .= "AND idjab='$idjab'";
        }
    }

    if (isset($_POST['cekagama'])) {
        $agama = $_POST['agama2'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "agama='$agama'";
        } else {
            $bagianWhere .= "AND agama='$agama'";
        }
    }


    if (isset($_POST['cekjk'])) {
        $jk = $_POST['jk2'];
        if (empty($bagianWhere)) {
            $bagianWhere .= "id_jk='$jk'";
        } else {
            $bagianWhere .= "AND id_jk='$jk'";
        }
    }

    $message=$_POST['pesan'];
    if($message==""){
    	 echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> Maaf Pesan tidak boleh kosong <br/></div>";
    }else {
    	$query = "SELECT no_hp from tbl_pegawai
             WHERE " . $bagianWhere;
	   $hasil = mysqli_query($mysqli, $query);
	   $j_data = mysqli_num_rows($hasil);

		while ($row = mysqli_fetch_array($hasil)) {
	      $query2 = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('" . $row['no_hp'] . "', '$message', 'Gammu')";
	      $hasil2 = mysqli_query($mysqli,$query2);

		      if ($hasil2 > 0) {
		          echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Kirim ke no " . $row['no_hp'] . " $j_data<br/></div>";
		      } else {
		          echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
		      }

	  	}
    }
    




}

?>