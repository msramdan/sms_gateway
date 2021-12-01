<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  ) 

{
// panggil berkas koneksi.php
include "../config/koneksi.php";
//SourceCode by AndezNET.com

?>

 <div class="span8">
    <div class="table-responsive">

<table class="table table-striped" cellspacing="0" width="100%">
<thead>
    <tr>
        <th class="site-footer">NO</th>
        <th class="site-footer">NO HP TUJUAN</th>
        <th class="site-footer">ISI SMS</th>
        <th class="site-footer">WAKTU</th>
        <th class="site-footer"></th>
    </tr>
</thead>
<tbody>
    <?php 
        $i = 1;
        $jml_per_halaman = 5; // jumlah data yg ditampilkan perhalaman
        $jml_data = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM tbl_schedule order by id desc"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
		$current_date = date("Y-m-d H:i:s");
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mysqli_query($mysqli,"
                SELECT * FROM tbl_schedule
                WHERE DestinationNumber LIKE '%$kunci%'
                OR TextDecoded LIKE '%$kunci%'
				OR Time LIKE '%$kunci%'
				order by id desc
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            $query = mysqli_query($mysqli,"SELECT * FROM tbl_schedule order by id desc LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            $query = mysqli_query($mysqli,"SELECT * FROM tbl_schedule order by id desc  LIMIT 0, $jml_per_halaman");
            $halaman = 1; //tambahan
        }
         while($data = mysqli_fetch_array($query)){

    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['DestinationNumber'] ?></td>
        <td><?php echo $data['TextDecoded'] ?></td>
        <td><?php echo $data['Time']  ?> <span class="label label-danger"><?php if($data['Time'] < $current_date){ echo "EXPIRED";}?></span></td>
        <td><div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
					<li>
					<a data-toggle="modal" id="<?php echo $data['id'] ?>" class="ubah btn" data-target="#dialog-auto">
					<i class="fa fa-edit"> Edit</i></a>
					</li>
                    <li><a href="#" id="<?php echo $data['id'] ?>" class="hapus btn">
                            <i class="fa fa-trash-o"> Hapus</i>
                        </a>
					</li>
					
                </ul>
            </div>
        </td>

    </tr>

    <?php
        $i++;
        }
    ?>
</tbody>
</table>

 </div>
<?php if(!isset($_POST['cari'])) { ?>
<!-- untuk menampilkan menu halaman -->
<div class="pagination">
  <ul>

    <?php

    // tambahan
 
    $no_hal_tampil = 5;

    if ($jml_halaman <= $no_hal_tampil) {
        $no_hal_awal = 1;
        $no_hal_akhir = $jml_halaman;
    } else {
        $val = $no_hal_tampil - 2; //3
        $mod = $halaman % $val; //
        $kelipatan = ceil($halaman/$val);
        $kelipatan2 = floor($halaman/$val);

        if($halaman < $no_hal_tampil) {
            $no_hal_awal = 1;
            $no_hal_akhir = $no_hal_tampil;
        } elseif ($mod == 2) {
            $no_hal_awal = $halaman - 1;
            $no_hal_akhir = $kelipatan * $val + 2;
        } else {
            $no_hal_awal = ($kelipatan2 - 1) * $val + 1;
            $no_hal_akhir = $kelipatan2 * $val + 2;
        }

        if($jml_halaman <= $no_hal_akhir) {
            $no_hal_akhir = $jml_halaman;
        }
    }

    for($i = $no_hal_awal; $i <= $no_hal_akhir; $i++) {
        // tambahan
        // menambahkan class active pada tag li
        $aktif = $i == $halaman ? ' active' : '';
    ?>
	<ul class="pagination">

    <li class="halaman<?php echo $aktif ?>" id="<?php echo $i ?>"><a href="#"><?php echo $i ?></a></li>

    </ul>

    <?php } ?>

  </ul>
</div>
</div>
<?php } ?>
 
<?php 

?>
<?php
}else{
	session_destroy();
	header('Location:../index.php?status=Silahkan Login');
}
?>