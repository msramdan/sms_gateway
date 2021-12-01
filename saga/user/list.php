<?php
error_reporting();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2'  )
//SourceCode by AndezNET.com
{

include "action.php";
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
                        <a class="btn btn-info" href="?id=formuser">
                            <i class="fa fa-pencil-square-o"></i>
                            Tambah
                            <span class="badge badge-warning badge-right"></span>
                        </a>

                        <a href="?id=user" class="btn btn-success ">
                            <i class="fa fa-refresh "></i>
                            Refresh
                        </a>
                        <p> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</p>
                    </div>
                    </thead>
                    <div id="data-group"></div>
                </section>

            </div><!-- /content-panel -->
        </div><!-- /col-lg-4 -->
    </div><!-- /row -->



<?php
}else{
	  echo "<script>alert('Mohon Maaf anda tidak bisa akses halaman ini'); window.location = '../index.php'</script>";
}
?>