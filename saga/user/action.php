<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{
include "../config/koneksi.php";
error_reporting();

// jika yang dipilih tombol hapus
// proses menghapus data
if(isset($_POST['hapus'])) {
	mysqli_query($mysqli,"DELETE FROM tbl_user WHERE id_user=".$_POST['hapus']);
} else if (isset($_POST['simpan'])){

	// deklarasikan variabel
	$iduser		= $_POST['iduser'];
	$username	= $_POST['nama'];
	$password	= $_POST['password'];
	$passmd5	= md5($password);
	$email		= $_POST['email'];
	$nohp		= $_POST['nohp'];

	// validasi agar nama tidak dikosongkan
	if($username!="") {
		// proses tambah data
		if($iduser == 0) {
			$querycek=mysqli_query($mysqli,"select username from tbl_user where username='$username'");
			$rowcek=mysqli_num_rows($querycek);
			if($rowcek==0){
				$queryinsert=mysqli_query($mysqli,"INSERT INTO tbl_user (username,pass,nohp,email,level_user) VALUES('$username','$passmd5','$nohp','$email','1')");
				if ($queryinsert) {
					echo "<script>alert('Berhasil di Simpan');window.location.replace('?id=user');
								</script>";
				} else {
					echo "<h4 class='alert_error'>".mysqli_error($mysqli)."<span id='close'>[<a href='#'>X</a>]</span></h4>";
				}

			}else{
				echo "<script>alert('Maaf Username sudah tersedia');window.location.replace('?id=user');
								</script>";
			}
			
			
		// proses ubah data
		} else {

			if(empty($_GET[password])){
				$q_pelanggan=mysqli_query($mysqli,"UPDATE tbl_user SET
			username = '$username',
			email = '$email',
			nohp='$nohp'
			WHERE id_user= '$iduser'
			");

			}else{
				$q_pelanggan=mysqli_query($mysqli,"UPDATE tbl_user SET
			username = '$username',
			email = '$email',
			password = '$password',
			nohp='$nohp'
			WHERE id_user= '$iduser'
			");
			}

			if ($q_pelanggan) {
					echo "<script>alert('Berhasil di update');window.location.replace('?id=user');
								</script>";
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