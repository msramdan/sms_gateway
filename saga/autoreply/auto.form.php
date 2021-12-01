<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com

{

    include "../config/koneksi.php";


    $id_auto = $_POST['id'];

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_autoreply WHERE id=".$id_auto));


    if($id_auto > 0) {
        $id_auto = $data['id'];
        $pesan= $data['pesan'];

    } else  {
        $id_auto = "";
        $pesan= "";
    }

    ?>

    <form class="form-horizontal style-form" id="form-auto">

        <div class="form-group" hidden="hidden">
            <label class="col-sm-2 col-sm-2 control-label">id</label>
            <div class="col-sm-2">
                <input type="text" name="id_auto" id="id_auto" value="<?php echo $id_auto ?>">
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Pesan</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="pesan" id="pesan"><?php echo $pesan ?></textarea>
                <span id="msg3"></span>
            </div>

        </div>

   



    </form>


<script src="assets/js/select2.min.js"></script> 



<script type="text/javascript">
          setTimeout(function() {Ajax();}, 10000);

          $(document).ready(function(){
             $("#no_forward").select2({
                
                // allowClear: true
                ajax: {
                  url: 'cariphone.php',
                  dataType: 'json',
                  delay: 250,
                  processResults: function (data) {

                       
                      return {
                            
                            results: data 
                        
                     
                      };  

                    
                  },
                  cache: true
                }
             }); 


          });  
      </script>


<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>