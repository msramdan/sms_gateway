<?php
 session_start();
//SourceCode by AndezNET.com
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  ) {

    include "../config/koneksi.php";

?>


 <div class="span8">
    <div class="table-responsive">

<table class="table table-striped" cellspacing="0" width="100%">
<thead>
    <tr>
        <th class="site-footer">NO</th>
        <th class="site-footer">Name</th>
        <th class="site-footer">Jumlah</th>
        <th class="site-footer">Kode</th>
        <th class="site-footer"></th>
    </tr>
</thead>
<tbody>
<?php 
        $i = 1;
        $jml_per_halaman = 7; // jumlah data yg ditampilkan perhalaman
        $jml_data = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM tbl_polling "));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mysqli_query($mysqli,"
                SELECT * FROM tbl_polling
                WHERE name LIKE '%$kunci%'
                OR kode LIKE '%$kunci%'
				order by name ASC
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            $query = mysqli_query($mysqli,"SELECT * FROM tbl_polling
		 order by name DESC LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            $query = mysqli_query($mysqli,"SELECT * FROM tbl_polling
		 order by name DESC LIMIT 0, $jml_per_halaman");
            $halaman = 1; //tambahan
        }
         while($data = mysqli_fetch_array($query)){

    ?>
		<tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['name'] ?></td>
        <td><?php echo $data['jumlah'] ?></td>
        <td><?php echo $data['kode'] ?></td>

        <td><div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
					<li>
					<a data-toggle="modal" id="<?php echo $data['id'] ?>" class="ubah" data-target="#dialog-pb">
					<i class="fa fa-edit"> Edit</i></a>
					</li>
                    <li>
					<a href="?id=polling&mod=del&idpolling=<?php echo $data['id'] ?>" onclick="return confirm('Menghapus Name <?php echo $data['name'] ?>')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
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


<div class="modal fade" id="myModal<?php echo $data['ID'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                             <h4 class="modal-title" id="myModalLabel">Kirim Pesan</h4>
                         </div>
                         <div class="modal-body">
                             <form class="form-horizontal style-form" action="?id=pb" method="post">
                                 <div class="form-group">
                                     <label class="col-sm-2 col-sm-2 control-label">To</label>
                                     <div class="col-sm-10">
                                         <input type="text" class="form-control" name="nohp" placeholder="Isikan No Hp Tujuan" value="<?php echo $data['Number'] ?>" required>
                                     </div>
                                 </div>

                                 <div class="form-group">
                                     <label class="col-sm-2 col-sm-2 control-label">Pesan</label>
                                     <div class="col-sm-10">
                                         <textarea type="text" class="form-control" name="pesan" placeholder="Isikan Pesan" required></textarea>
                                     </div>

                                 </div>
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 <input type="submit" class="btn btn-primary" name="input" value="KIRIM"></form>
                         </div>
                         <div class="modal-footer">

                         </div>

                     </div>
                 </div>
             </div>

    <?php if(!isset($_POST['cari'])) { ?>
<!-- untuk menampilkan menu halaman -->
<div class="pagination">
  <ul>

    <?php

    // tambahan
    // panjang pagig yang akan ditampilkan
    $no_hal_tampil = 5; // lebih besar dari 3

    if ($jml_halaman <= $no_hal_tampil) {
        $no_hal_awal = 1;
        $no_hal_akhir = $jml_halaman;
    } else {
        $val = $no_hal_tampil - 3; //3
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
    <?php } ?>
<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>