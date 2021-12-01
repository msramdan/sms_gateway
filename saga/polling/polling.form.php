<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{

    include "../config/koneksi.php";


    $idpolling = $_POST['id'];

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_polling WHERE id='$idpolling'"));

    if($idpolling > 0) {
        $id_polling = $data['id'];
        $name = $data['name'];
        $kode = $data['kode'];
        $ket= "Edit";

    } else  {
        $id_polling = "";
        $name = "";
        $kode = "";
        $ket= "Tambah";

    }

    ?>


    <form class="form-horizontal style-form" action="?id=polling" method="POST" id="uploadAjaxImage" enctype="multipart/form-data">

        <div class="form-group" hidden="hidden">
            <label class="col-sm-2 col-sm-2 control-label">ID</label>
            <div class="col-sm-2">
                <input type="text" name="idpolling" id="idpolling" value="<?php echo $id_polling ?>">
            </div>
        </div>

        

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Kode</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="kode" id="kode" placeholder="Isikan Kode" value="<?php echo $kode ?>" required>
            </div>
        </div>



        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
        <input type="submit" name="tb_act" class="btn btn-primary" VALUE="<?php echo $ket?>">
    </form>







<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>