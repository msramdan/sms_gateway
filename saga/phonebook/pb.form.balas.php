<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com
{

    include "../config/koneksi.php";


    $id_pbk = $_POST['id'];

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM pbk WHERE ID='$id_pbk'"));

    if($id_pbk > 0) {
        $id_pbk = $data['ID'];
        $idgroup= $data['GroupID'];
        $nama = $data['Name'];
        $nohandphone = $data['Number'];
        $foto = $data['Foto'];
        $ket= "Edit";

    } else  {
        $id_pbk = "";
        $idgroup= "";
        $nama = "";
        $nohandphone  = "";
        $foto = "assets/img/noname.jpg";
        $ket= "Tambah";

    }

    ?>


    <form class="form-horizontal style-form" action="?id=pb" method="post">
         <div class="form-group">
             <label class="col-sm-2 col-sm-2 control-label">To</label>
             <div class="col-sm-10">
                 <input type="text" class="form-control" name="nohp[]" placeholder="Isikan No Hp Tujuan" value="<?php echo $nohandphone ?>" readonly />
             </div>
         </div>

         <div class="form-group">
             <label class="col-sm-2 col-sm-2 control-label">Pesan</label>
             <div class="col-sm-10">
                 <textarea type="text" class="form-control" name="pesan" placeholder="Isikan Pesan" required></textarea>
             </div>

         </div>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="input" value="KIRIM">
    </form>


   
    </head>





<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>