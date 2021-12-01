<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{
    $no_hp	  = isset($_GET['nohp']) ? $_GET['nohp'] : NULL;
    $idultah  = isset($_GET['idultah']) ? $_GET['idultah'] : NULL;
    $mod 	  = isset($_GET['mod']) ? $_GET['mod'] : NULL;

    if ($mod == "del") {
        $q_delete_outbox = mysqli_query($mysqli,"DELETE FROM outbox WHERE DestinationNumber = '$no_hp'");
        $q_delete_outbox = mysqli_query($mysqli,"DELETE FROM tbl_sms_ultah WHERE id= '$idultah'");
        if ($q_delete_outbox) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Hapus<br/></div>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
        }
    }

    if ($mod == "delall") {
        $q_deleteall_outbox = mysqli_query($mysqli,"DELETE FROM outbox");
        $q_deleteall_smsultah = mysqli_query($mysqli,"DELETE FROM tbl_sms_ultah");

        if ($q_deleteall_outbox >0) {
            echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Hapus<br/></div>";
        } else {
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli,$q_deleteall_sent)."<br/></div>";
        }
    }
    ?>

    <h3><i class="fa fa-angle-right"></i><?php echo $judul ?></h3>
    <div class="row mt">
        <div class="col-lg-12">
            <div class="content-panel">
                <section id="unseen">

                    <!-- textbox untuk pencarian -->
                    <div class="weather-2">
                        <span class="add-on"><i class="icon-search"></i></span>

                        <thead>
                        <div class="col-sm-2">
                            <input class="form-control round-form" type="text" name="pencarian" placeholder="Pencarian..">
                        </div>

                        <a class="btn btn-danger" href="?id=smsultah&mod=delall" onclick="return confirm ('Menghapus semua pesan?')">Hapus all</a>

                        <a href="?id=smsultah" class="btn btn-success ">
                            <i class="fa fa-refresh bigger-160"></i>
                            Refresh
                        </a>

                        <p> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </p>
                    </div>
                    </thead>
                    <div id="data-smsultah"></div>
                </section>

            </div><!-- /content-panel -->
        </div><!-- /col-lg-4 -->
    </div><!-- /row -->

<!-- awal untuk modal dialog -->

<?php
}else{
	  echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>