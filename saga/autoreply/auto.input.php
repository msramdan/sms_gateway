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
	mysqli_query($mysqli,"DELETE FROM tbl_autoreply WHERE id=".$_POST['hapus']);
} else {
	// deklarasikan variabel
	$id_auto	= $_POST['id_auto'];
	$pesan 		= $_POST['pesan'];

	// validasi agar tidak ada data yang kosong
	if($pesan!="") {
		// proses tambah data
		if($id_auto == 0) {
			mysqli_query($mysqli,"INSERT INTO tbl_autoreply VALUES('','$pesan')");
		// proses ubah data
		} else {
			$q_auto=mysqli_query($mysqli,"UPDATE tbl_autoreply SET
			pesan = '$pesan'
			WHERE id= $id_auto
			");

			if ($q_auto) {
					echo "<h4 class='alert_success'>Data berhasil ditambahkan <a href=''>Cetak</a><span id='close'>[<a href='#'>X</a>]</span></h4>";
				} else {
					echo "<h4 class='alert_error'>".mysql_error()."<span id='close'>[<a href='#'>X</a>]</span></h4>";
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