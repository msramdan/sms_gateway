<?php
include "config/koneksi.php";
//SourceCode by AndezNET.com
$query = "SELECT * FROM inbox WHERE Processed = 'false'";
$hasil = mysqli_query($mysqli,$query);


$querysetting = mysqli_query($mysqli,"SELECT kode_awal,pemisah from tbl_set_pol where idset='1'");
$rowsetting= mysqli_fetch_array($querysetting); 


while ($data = mysqli_fetch_array($hasil))
{
  
  $id = $data['ID'];
  $noPengirim = $data['SenderNumber'];
  $msg = strtoupper($data['TextDecoded']);
  $pecah = explode("$rowsetting[pemisah]", $msg);
  $kode = $pecah[1];
  

    $query1 = "SELECT kode FROM tbl_polling WHERE kode='$pecah[1]'";
    $hasil1 = mysqli_query($mysqli,$query1);
    $data1 = mysqli_fetch_array($hasil1);

    if ($pecah[0] == $rowsetting[0])
    { 
        $ceklog=mysqli_query($mysqli,"SELECT * FROM tbl_log_polling where nohp='$noPengirim'");
        $rowceklog=mysqli_num_rows($ceklog);
        if($rowceklog > 0){
            $reply = "Maaf, anda sudah melakukan polling sms";
          }else{
             
             if (mysqli_num_rows($hasil1) < 1)
             $reply = "Kode tidak ditemukan";
             else
             {  
                $data2 = mysqli_fetch_array($hasil2);
                $jumlah=$data2[2];
                $hasilpolling=$jumlah + 1;
                $queryupdatepolling=mysqli_query($mysqli,"UPDATE tbl_polling set jumlah='$hasilpolling' where kode='$kode'");
                $querylog=mysqli_query($mysqli,"INSERT into tbl_log_polling (nohp,kode)values('$noPengirim','$kode') ");
                $reply = "Terima kasih sudah melakukan polling sms";
             }
        }

      

     }elseif($pecah[0]=="HASIL" && $pecah[1]=="POLLING"){
      $kodehasil=$pecah[2];
      $query2 = "SELECT * FROM tbl_polling where kode='$kodehasil'";
      $hasil2 = mysqli_query($mysqli,$query2);
      $rowhasil2 = mysqli_fetch_array($hasil2);
      $reply = "Hasil Pemelihan suara a/n $rowhasil2[1], adalah $rowhasil2[2] suara";
     
    }else{
     $reply = "Maaf Perintah salah"; 
    }
	  
  $query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded) VALUES ('$noPengirim', '$reply')";
  $hasil3 = mysqli_query($mysqli,$query3);
 
  $query4 = "UPDATE inbox SET Processed = 'true' WHERE ID = '$id'";
  $hasil4 = mysqli_query($mysqli,$query4);		
	
}