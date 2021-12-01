<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com

{
include "../config/koneksi.php";
error_reporting(0);

// proses menghapus data
if(isset($_POST['hapus'])) {
	$carisch=mysqli_query($mysqli,"select nama_event from tbl_schedule where id=".$_POST['hapus']);
	$rowsch=mysqli_fetch_array($carisch);
	$namasch=$rowsch[0];	
	mysqli_query($mysqli,"DELETE FROM tbl_schedule WHERE id=".$_POST['hapus']);
	mysqli_query($mysqli,"DROP EVENT IF EXISTS ".$namasch." ");
	
	
} else {
	// deklarasikan variabel
	$id_auto	= $_POST['id_auto'];
	$waktu		= $_POST['waktu'];
	$pesan		= $_POST['pesan'];
	$nohp 		= $_POST['nohp'];
	$group		= $_POST['group'];

	// validasi agar tidak ada data yang kosong
	if($pesan!=""||$waktu!="") {
		// proses tambah data
		if($id_auto == 0) {
			if($group==0){
			
			$carimax=mysqli_query($mysqli,"select max(id) from tbl_schedule");
			$noschedule=mysqli_fetch_array($carimax);
			$datanosch=$noschedule[0] + 1;
					
			mysqli_query($mysqli,"INSERT INTO tbl_schedule VALUES('','$nohp','$pesan','Gammu','$waktu','saga_event_$datanosch')");
			mysqli_query($mysqli,"SET GLOBAL event_scheduler='ON'");
			
			
			mysqli_query($mysqli,"
					CREATE EVENT IF NOT EXISTS saga_event_".$datanosch."
					ON SCHEDULE AT '".$waktu."' ON COMPLETION NOT PRESERVE ENABLE 
					DO
					  INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$nohp', '$pesan', 'Gammu')
			");
			}else {

				$query = mysqli_query($mysqli, "SELECT * FROM pbk WHERE GroupID='".$group."'");
				  while ($row = mysqli_fetch_array($query)) {
				      $carimax=mysqli_query($mysqli,"select max(id) from tbl_schedule");
						$noschedule=mysqli_fetch_array($carimax);
						$datanosch=$noschedule[0] + 1;
								
						mysqli_query($mysqli,"INSERT INTO tbl_schedule VALUES('','$row[Number]','$pesan','Gammu','$waktu','saga_event_$datanosch')");
						mysqli_query($mysqli,"SET GLOBAL event_scheduler='ON'");
						
						
						mysqli_query($mysqli,"
								CREATE EVENT IF NOT EXISTS saga_event_".$datanosch."
								ON SCHEDULE AT '".$waktu."' ON COMPLETION NOT PRESERVE ENABLE 
								DO
								  INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$row[Number]', '$pesan', 'Gammu')
						");

				  }

			}
			
		// proses ubah data
		} else {
			$q_auto=mysqli_query($mysqli,"UPDATE tbl_schedule SET
			DestinationNumber = '$nohp',
			TextDecoded = '$pesan',
			Time = '$waktu'
			WHERE id= '$id_auto'
			");

			$cekevent=mysqli_query($mysqli,"SELECT nama_event FROM tbl_schedule where id='$id_auto'");
			$rowcekevent=mysqli_fetch_array($cekevent);
			$nama_event=$rowcekevent[0];
			mysqli_query($mysqli,"DROP EVENT $nama_event");
			mysqli_query($mysqli,"
								CREATE EVENT IF NOT EXISTS $nama_event
								ON SCHEDULE AT '".$waktu."' ON COMPLETION NOT PRESERVE ENABLE 
								DO
								  INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$nohp', '$pesan', 'Gammu')
						");

			if ($q_auto) {
					echo "<h4 class='alert_success'>Data berhasil ditambahkan <a href=''>Cetak</a><span id='close'>[<a href='#'>X</a>]</span></h4>";
				} else {
					echo "<h4 class='alert_error'>".mysqli_error($mysqli)."<span id='close'>[<a href='#'>X</a>]</span></h4>";
				}

		}
	}
}

?>
<?php
}else{
	session_destroy();
	header('Location:../index.php?status=Silahkan Login');
}
?>