<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com

{

    include "config/koneksi.php";


    $id_auto = $_POST['id'];

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_setting WHERE idset='1'"));


        $idset = $data['idset'];
        $set_autoreply= $data['set_autoreply'];
        $set_ultah = $data['set_ultah'];
        $set_autorespon = $data['set_autorespon'];
        $set_pesan_ultah= $data['set_pesan_ultah'];

    if (isset($_POST['simpan'])){
        $querysaveset=mysqli_query($mysqli,"UPDATE tbl_setting set set_autoreply='$_POST[set_autoreply]',set_ultah='$_POST[set_ultah]',set_autorespon='$_POST[set_autorespon]',set_pesan_ultah='$_POST[set_pesan_ultah]' where idset='1' ");

        if ($querysaveset) {
            echo "<script>alert('Berhasil di update');window.location.replace('?id=setautosms');</script>";
        } else {
            echo "<h4 class='alert_error'>".mysqli_error($mysqli)."<span id='close'>[<a href='#'>X</a>]</span></h4>";
        }
    }
    
    ?>




    <h3><i class="fa fa-angle-right"></i><?php echo $judul ?></h3>
    <div class="row mt">
      <div class="col-lg-12">
        <div class="form-panel">
          <div class="weather-2">
            
          </div>
          <hr>
            <form class="form-horizontal style-form" id="form-auto" action="?id=setautosms" method="POST">

        <div class="form-group" hidden="hidden">
            <label class="col-sm-2 col-sm-2 control-label">id</label>
            <div class="col-sm-2">
                <input type="text" name="idset" id="idset" value="<?php echo $idset ?>">
            </div>
        </div>

        <div class="form-group">
         <label class="col-sm-2 col-sm-2 control-label">Autoreply</label>
            <div class="col-sm-6">
                <input name="set_autoreply" type="radio" id="set_autoreply" value="1" 
                    <?php if($set_autoreply==1) { 
                        echo 'checked="checked"'; 
                    }
                    ?> 
                    <span class="lbl"> YES  </span>
                
            </div>
            <div class="col-sm-6">
                <input name="set_autoreply" type="radio" id="set_autoreply" value="0" 
                    <?php if($set_autoreply==0) { 
                        echo 'checked="checked"'; 
                    }
                    ?> 
                    <span class="lbl"> NO</span>
            </div>

        </div>


        <div class="form-group">
         <label class="col-sm-2 col-sm-2 control-label">Autorespon</label>
            <div class="col-sm-6">
                <input name="set_autorespon" type="radio" id="set_autorespon" value="1" 
                    <?php if($set_autorespon==1) { 
                        echo 'checked="checked"'; 
                    }
                    ?> 
                    <span class="lbl"> YES </span>
                
            </div>
            <div class="col-sm-6">
                <input name="set_autorespon" type="radio" id="set_autorespon" value="0" 
                    <?php if($set_autorespon==0) { 
                        echo 'checked="checked"'; 
                    }
                    ?> 
                    <span class="lbl"> NO</span>
            </div>

        </div>


        <div class="form-group">
         <label class="col-sm-2 col-sm-2 control-label">Autoultah</label>
            <div class="col-sm-6">
                <input name="set_ultah" type="radio" id="set_ultah" value="1" 
                    <?php if($set_ultah==1) { 
                        echo 'checked="checked"'; 
                    }
                    ?> 
                    <span class="lbl"> YES </span>
                
            </div>
            <div class="col-sm-6">
                <input name="set_ultah" type="radio" id="set_ultah" value="0" 
                    <?php if($set_ultah==0) { 
                        echo 'checked="checked"'; 
                    }
                    ?> 
                    <span class="lbl"> NO</span>
            </div>

        </div>




        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Pesan Ultah</label>
            <div class="col-sm-6">
                <textarea class="form-control" name="set_pesan_ultah"><?php echo $set_pesan_ultah ?></textarea>
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