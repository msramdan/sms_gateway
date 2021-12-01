<?php
 session_start();
 $sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{
// require "config/excel_reader.php";

?>
<h3><i class="fa fa-angle-right"></i><?php echo $judul ?></h3>
    <?php
    $maxsize        = 2097152;
    $idpolling  	= isset($_POST['idpolling']) ? $_POST['idpolling'] : NULL;
    $name  	        = isset($_POST['name']) ? $_POST['name'] : NULL;
    $kode	        = isset($_POST['kode']) ? $_POST['kode'] : NULL;
    $idset          = isset($_POST['idset']) ? $_POST['idset'] : NULL;
    $judul          = isset($_POST['judul']) ? $_POST['judul'] : NULL;
    $pemisah        = isset($_POST['pemisah']) ? $_POST['pemisah'] : NULL;
    $kode_awal      = isset($_POST['kode_awal']) ? $_POST['kode_awal'] : NULL;
    $tb_act 		= isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
    $mod 		    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $id_polling	    = isset($_GET['idpolling']) ? $_GET['idpolling'] : NULL;
   

    $queryset=mysqli_query($mysqli,"SELECT * from tbl_set_pol where idset='1'");
    $rowset=mysqli_fetch_array($queryset);

    $querytotal=mysqli_query($mysqli,"SELECT sum(jumlah) as jum from tbl_polling");
    $rowtotal=mysqli_fetch_array($querytotal);

//============================

    if ($tb_act == "Tambah") {
        if ($name != "" && $kode != "") {

            $querycekkode=mysqli_query($mysqli,"SELECT * from tbl_polling where kode='$kode'");
            $rownum=mysqli_num_rows($querycekkode);
            
            if($rownum  < 1){
                $q_tambah = mysqli_query($mysqli, "INSERT INTO tbl_polling VALUES ('','$name','','$kode')");
                if ($q_tambah > 0) {
                    echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL </strong> data polling Berhasil disimpan<br/></div>";
                } else {
                    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                }
            }else{
                 echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong> Data Kode double <br/></div>";
            }

             
            
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>Data Error<br/></div>";
        }

    }


    if ($tb_act == "Edit") {

        if ($name != "" && $kode != "") {
            $q_edit2 = mysqli_query($mysqli, "UPDATE tbl_polling SET name='$name',kode='$kode' where id='$idpolling'");
                    if ($q_edit2 > 0) {
                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Phonebook Berhasil disimpan<br/></div>";
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
            
            
        } else {
            echo "<h4 class='alert alert_danger'>Lengkapi Isian<span id='close'>[<a href='#'>X</a>]</span></h4>";
        }

    }


    if ($tb_act == "SAVE") {

        if ($judul != "" && $kode_awal != "") {
            $q_edit3 = mysqli_query($mysqli, "UPDATE tbl_set_pol SET kode_awal='$kode_awal',judul='$judul',pemisah='$pemisah' where idset='$idset'");
                    if ($q_edit3 > 0) {
                        echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong> Seting Polling Berhasil disimpan<br/></div>";
                    } else {
                        echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" . mysqli_error($mysqli) . "<br/></div>";
                    }
            
            
        } else {
            echo "<h4 class='alert alert_danger'>Lengkapi Isian<span id='close'>[<a href='#'>X</a>]</span></h4>";
        }

    }else if ($mod == "del") {
        $q_delete_pb = mysqli_query($mysqli,"DELETE FROM tbl_polling WHERE id = '$id_polling'");
            if ($q_delete_pb > 0) {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong>  Menghapus Phonebook<br/></div>";
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
            }
    }else if ($mod == "dellog") {
        $q_delete_log = mysqli_query($mysqli,"DELETE FROM tbl_log_polling");
            if ($q_delete_log > 0) {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong>  Menghapus Semua Log<br/></div>";
                echo "<script>window.setTimeout(function(){window.location.href = '?id=polling';}, 1000);</script>";
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
            }
    }else if ($mod == "resetpol") {
        $q_reset_pol = mysqli_query($mysqli,"UPDATE tbl_polling set jumlah='0'");
            if ($q_reset_pol > 0) {
                echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class=''></i></button><strong><i class='ace-icon fa fa-check'></i> BERHASIL</strong>  Reset Polling sms<br/></div>";
                echo "<script>window.setTimeout(function(){window.location.href = '?id=polling';}, 1000);</script>";
            } else {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button><strong><i class='ace-icon fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
            }
    }
//SourceCode by AndezNET.com
    ?>
    <div class="row mt">
        <div class="col-lg-12">
            <div class="content-panel">
                <section id="unseen">

        <div class="col-sm-2">
        <input class="form-control round-form" type="text" name="pencarian" placeholder="Pencarian..">
        </div>

        <thead>
        <a  data-target="#dialog-pb" id="0" class="tambah btn btn-info" data-toggle="modal" >
            <i class="fa fa-pencil-square-o"></i>
            Tambah
            <span class="badge badge-warning badge-right"></span>
        </a>
		
        <a class="btn btn-danger" href="?id=polling&mod=resetpol" onclick="return confirm ('Reset polling sms ?')">
         <i class="fa fa-refresh bigger-160"></i>
         Reset
        </a>

        <a class="btn btn-danger" href="?id=polling&mod=dellog" onclick="return confirm ('Menghapus log sms polling?')">
            <i class="glyphicon glyphicon-trash"></i>
            Hapus Log 
        </a>

        <a  data-target="#dialog-setpol" id="0" class="btn btn-danger" data-toggle="modal" >
            <i class="fa fa-gear"></i>
            Setting
            <span class="badge badge-warning badge-right"></span>
        </a>

        <a href="autopolling.php" target="_blank" class="btn btn-primary" title="Jalankan Polling SMS">
            <i class="fa fa-flag"></i>
            Aktifkan
        </a>

        <a href="grafikpolling.php" target="_blank" class="btn btn-success" title="View Grafik">
            <i class="fa fa-eye"></i>
            View Grafik
        </a>

        <a href="#"  class="btn btn-danger" title="View Total">
            <i class="fa fa-eye"></i>
            Total <?php echo $rowtotal['jum'] ?> SMS
        </a>

        <br>
        <span><i>Ex. Format Kirim SMS: KODEAWAL#KODE  | Ex. Format cek Hasil HASIL#POLLING#KODE</i></span>
		
		

    </div>

    <div id="data-polling"></div>
    </thead>

                </section>

            </div><!-- /content-panel -->
        </div><!-- /col-lg-4 -->
    </div><!-- /row -->

    <div id="dialog-pb" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i id="myModalLabel">Polling SMS</i></h4>
                </div>

                <div class="modal-body">
                    <div class="polling"></div>
                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <div id="dialog-setpol" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i id="myModalLabel">Setting Polling</i></h4>
                </div>

                <div class="modal-body">
                     <form class="form-horizontal style-form" action="" method="POST" id="formsetting" enctype="multipart/form-data">
                   
                        <div class="form-group" hidden="hidden">
                            <label class="col-sm-2 col-sm-2 control-label">ID</label>
                            <div class="col-sm-2">
                                <input type="text" name="idset" id="idset" value="<?php echo $rowset[idset] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Kode Awal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_awal" id="kode_awal" placeholder="Masukan kode awal " value="<?php echo $rowset[kode_awal] ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Judul</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukan Judul Polling" value="<?php echo $rowset[judul] ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Pemisah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pemisah" id="pemisah" placeholder="Masukan Pemisah" value="<?php echo $rowset[pemisah] ?>" required>
                            </div>
                        </div>




                        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <input type="submit" name="tb_act" class="btn btn-primary" VALUE="SAVE">
                    </form>
                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
	
	
	


<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
    //SourceCode by AndezNET.com
}
?>

