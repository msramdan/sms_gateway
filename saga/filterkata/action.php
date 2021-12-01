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
	mysqli_query($mysqli,"DELETE FROM tbl_filter_kata WHERE idkata=".$_POST['hapus']);
} else {
	// deklarasikan variabel
	$idkata	= $_POST['idkata'];
	$nmkata	= $_POST['nmkata'];

	// validasi agar tidak ada data yang kosong
	if($nmkata!="") {
		// proses tambah data
		if($idkata == 0) {
			mysqli_query($mysqli,"INSERT INTO tbl_filter_kata VALUES('','$nmkata')");
		// proses ubah data
		} else {
			$q_group=mysqli_query($mysqli,"UPDATE tbl_filter_kata SET
			nm_kata = '$nmkata'
			WHERE idkata= $idkata
			");

			if ($q_group) {
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