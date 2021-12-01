<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{

    include "../config/koneksi.php";


if (isset($_GET['iduser']) && !empty($_GET['iduser'])) {
    $iduser = $_GET['iduser'];
    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_user WHERE id_user=".$iduser));
    $username   = $data['username'];
    $email= $data['email'];
    $nohp  = $data['nohp'];
    $passtext="Kosongkan bila tidak dirubah";    

}else{

    $username   = "";
    $email= "";
    $nohp  = "";
    $passtext="Isikan password";
}

    ?>

    <h3><i class="fa fa-angle-right"></i><?php echo $judul ?></h3>
    <div class="row mt">
      <div class="col-lg-12">
        <div class="form-panel">
          <div class="weather-2">
            <a href="?id=user" class="btn btn-danger pull-right">Batal</a>
          </div>
          <hr>
          <form class="form-horizontal style-form" method="post" action="?id=user">

            <div class="form-group" hidden="hidden">
                <label class="col-sm-2 col-sm-2 control-label">Id</label>
                <div class="col-sm-2">
                    <input type="text" name="iduser" id="id" value="<?php echo $iduser ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Username *</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Isikan Username" value="<?php echo $username ?>" required>
                </div>
            </div>

             <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Password </label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" id="password" placeholder="<?php echo $passtext ?>" value="" >
                </div>
            </div>

             <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">No HP *</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nohp" id="nohp" placeholder="Isikan No HP" value="<?php echo $nohp ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Isikan Email" value="<?php echo $email ?>" required>
                </div>
            </div>

            
            <button class="btn btn-success" name="simpan" type="sumbit">Simpan</button>

        </form>

        </div><!-- /content-panel -->
      </div><!-- /col-lg-4 -->
    </div><!-- /row -->

<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>