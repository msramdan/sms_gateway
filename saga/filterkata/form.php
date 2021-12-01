<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{

    include "../config/koneksi.php";


    $idkata = $_POST['id'];

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_filter_kata WHERE idkata=".$idkata));


    if($idkata > 0) {
        $idkata  = $data['idkata'];
        $nm_kata  = $data['nm_kata'];

    } else  {
        $idkata  = "";
        $nm_kata  = "";
    }

    ?>

    <form class="form-horizontal style-form" id="formjabatan">

        <div class="form-group" hidden="hidden">
            <label class="col-sm-2 col-sm-2 control-label">id</label>
            <div class="col-sm-2">
                <input type="text" name="idkata" id="idkata" value="<?php echo $idkata ?>">
            </div>

        </div>


        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nama Kata</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nmkata" id="nmkata" placeholder="Isikan Nama Kata" value="<?php echo $nm_kata ?>">
                <span id="msg1"></span>
            </div>
            
        </div>



    </form>

<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>