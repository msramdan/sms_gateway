<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com

{

    include "../config/koneksi.php";


    $id_auto = $_POST['id'];

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_autorespon WHERE ID=".$id_auto));


    if($id_auto > 0) {
        $id_auto = $data['id'];
        $keyword1= $data['keyword1'];
        $keyword2 = $data['keyword2'];
        $result = $data['result'];
        $idforward = $data['idforward'];
        $no_forward = $data['no_forward'];

    } else  {
        $id_auto = "";
        $keyword1= "";
        $keyword2 = "";
        $result = "";
        $idforward = "";
        $no_forward = "";
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
            <label class="col-sm-2 col-sm-2 control-label">Keyword 1</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="keyword1" id="keyword1" placeholder="" value="<?php echo $keyword1 ?>">
                <span id="msg1"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Keyword 2</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="keyword2" id="keyword2" placeholder="" value="<?php echo $keyword2 ?>">
                <span id="msg2"></span>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Result</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="result1" id="result1"><?php echo $result ?></textarea>
                <span id="msg3"></span>
            </div>

        </div>

        <div class="form-group">
         <label class="col-sm-2 col-sm-2 control-label">Forward</label>
               <div class="col-sm-4">
                    <select name="idforward" id="idforward" class="form-control">
                        
                        <?php 
                          
                            if($idforward==1){
                              echo "<option value='1' selected>Yes</option> ";
                              echo "<option value='0' >No</option> ";
                            }else{
                              echo "<option value='1' >Yes</option> ";
                              echo "<option value='0' selected>No</option> ";
                            }
                          


                  
                        ?>
                    </select>
                    
                </div>
        </div>

    

        <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">No Forward</label>
                <div class="col-sm-10">
                    <select name="no_forward" id="no_forward" class="form-control">
                        <option value="0"></option>
                        <?php 
                          $querynohp=mysqli_query($mysqli,"select * from pbk");
                          while ($rownohp=mysqli_fetch_array($querynohp)){
                            if($rownohp['Number']==$no_forward){
                              echo "<option value='".$rownohp['Number']."' selected>".$rownohp['Name']."</option> ";
                            }else{
                              echo "<option value='".$rownohp['Number']."' >".$rownohp['Name']."</option> ";
                            }
                          }


                  
                        ?>
                    </select>
                    <span id="msg1"></span>
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