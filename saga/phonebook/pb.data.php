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
        <th class="site-footer"></th>
        <th class="site-footer">NO HP</th>
        <th class="site-footer">NAMA KONTAK</th>
        <th class="site-footer">TGL LAHIR</th>
        <th class="site-footer">GROUP</th>
        <th class="site-footer"></th>
    </tr>
</thead>
<tbody>
<?php 
        $i = 1;
        $jml_per_halaman = 7; // jumlah data yg ditampilkan perhalaman
        $jml_data = mysqli_num_rows(mysqli_query($mysqli,"SELECT a.ID,a.Name,a.Number,a.Foto,a.tgl_lahir, b.NameGroup as NameGroup FROM pbk a
		LEFT JOIN pbk_groups b on a.GroupID=b.GroupID
		 order by a.Name ASC"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mysqli_query($mysqli,"
             SELECT a.ID,a.Name,a.Number,a.Foto,a.tgl_lahir, b.NameGroup as NameGroup FROM pbk a
		LEFT JOIN pbk_groups b on a.GroupID=b.GroupID
                WHERE a.Name LIKE '%$kunci%'
                OR a.Number LIKE '%$kunci%'
				order by a.Name ASC
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            $query = mysqli_query($mysqli,"SELECT a.ID,a.Name,a.Number,a.tgl_lahir,a.Foto, b.NameGroup as NameGroup FROM pbk a
		LEFT JOIN pbk_groups b on a.GroupID=b.GroupID
		 order by a.Name DESC LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            $query = mysqli_query($mysqli,"SELECT a.ID,a.Name,a.Number,a.Foto,a.tgl_lahir, b.NameGroup as NameGroup FROM pbk a
		LEFT JOIN pbk_groups b on a.GroupID=b.GroupID
		 order by a.Name DESC LIMIT 0, $jml_per_halaman");
            $halaman = 1; //tambahan
        }
         while($data = mysqli_fetch_array($query)){

    ?>
		<tr>
        <td><?php echo $i ?></td>
        <td><img src="<?php echo $data['Foto'] ?>" height="50" width="50"></td>
        <td><?php echo $data['Number'] ?></td>
        <td><?php echo $data['Name'] ?></td>
        <td><?php echo $data['tgl_lahir']  ?></td>
        <td><?php echo $data['NameGroup']  ?></td>
        <td><div class="btn-group">
                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
					<li>
						<a data-toggle="modal" id="<?php echo $data['ID'] ?>" class="balaspesan" data-target="#dialog-balaspesan">
                        <i class="fa fa-envelope"> Balas Pesan</i></a>
					</li>
					<li>
					<a data-toggle="modal" id="<?php echo $data['ID'] ?>" class="ubah" data-target="#dialog-pb">
					<i class="fa fa-edit"> Edit</i></a>
					</li>
                    <li>
					<a href="?id=pb&mod=del&idpbk=<?php echo $data['ID'] ?>" onclick="return confirm('Menghapus Phonebook <?php echo $data['Name'] ?>')"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
					</li>
					
                </ul>
            </div>
        </td>

    </tr>


 </div>
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