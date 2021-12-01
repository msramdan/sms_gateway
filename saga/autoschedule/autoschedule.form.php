<?php
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
//SourceCode by AndezNET.com

{

    include "../config/koneksi.php";


    $id_auto = $_POST['id'];

    $data = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_schedule WHERE id=".$id_auto));


    if($id_auto > 0) {
        $id_auto 			= $data['id'];
        $DestinationNumber	= $data['DestinationNumber'];
        $TextDecoded		= $data['TextDecoded'];
        $Time 				= $data['Time'];
        $Group        ="hidden";

    } else  {
        $id_auto 			= "";
        $DestinationNumber	= "";
        $TextDecoded		= "";
        $Group        ="";
        $Time 				= "";
    }

    ?>
 <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">

    <form class="form-horizontal style-form" id="form-auto">

        <div class="form-group" hidden="hidden">
            <label class="col-sm-2 col-sm-2 control-label">id</label>
            <div class="col-sm-2">
                <input type="text" name="id_auto" id="id_auto" value="<?php echo $id_auto ?>">
            </div>

        </div>

        

        <!-- <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">NO HP</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="nohpsch" id="nohpsch" placeholder="" value="<?php echo $DestinationNumber ?>" required>
            </div>
            <span id="msg1"></span>
        </div> -->


        <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Kontak</label>
                <div class="col-sm-10">
                    <select name="nohpsch" id="nohpsch" class="form-control">
                        <option value="0"></option>
                        <?php 
                          $querynohp=mysqli_query($mysqli,"select * from pbk");
                          while ($rownohp=mysqli_fetch_array($querynohp)){
                            if($rownohp['Number']==$DestinationNumber){
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

        <div class="form-group" <?php echo $Group ?>>
            <label class="col-sm-2 col-sm-2 control-label">Group</label>
                 <div class="col-sm-10">

                      <select name="group" id="groupauto" class="form-control">
                        <option value='0' selected>- Pilih Grups -</option>

                                                  <?php
                                                  $q = mysqli_query($mysqli,"select * from pbk_groups");

                                                  while ($a = mysqli_fetch_array($q)){

                                                          echo "<option value='$a[1]'>$a[0]</option>";

                                                  }
                                                  ?>
                                                  ?>
                       </select>
                    </div>
         </div>    
        

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Isi Pesan</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="pesansch" id="pesansch" required><?php echo $TextDecoded ?> </textarea>
                <span id="msg2"></span>
            </div>
            
        </div>


        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">TIME</label>
            <div class="col-sm-10">
               <input type="text" id="datetime24" class="form-control" required data-format="YYYY-MM-DD HH:mm:ss" data-template="YYYY / MM / DD  HH : mm : ss" name="waktu" value="<?php echo $Time; ?>"></br> YYYY / MM / DD  HH : mm : ss
               <span id="msg3"></span>
            </div>
            
        </div>


    </form>
	

<script src="assets/js/moment.min.js"></script> 
<script src="assets/js/combodate.js"></script> 	
<script src="assets/js/select2.min.js"></script> 



<script type="text/javascript">
          setTimeout(function() {Ajax();}, 10000);

          $(document).ready(function(){
             $("#nohpsch").select2({
                
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

<script>
$(function(){
	$('#datetime24').combodate({
    minYear: 2015,
    maxYear: 2020,
    minuteStep: 1
});   
});
</script>
	
	

<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>