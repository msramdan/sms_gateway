<?php
//SourceCode by AndezNET.com
session_start();
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )

{
?>
<div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->

	<img src="logosaga.png" class="img-responsive" >
     <input type='submit' class='btn btn-info' name='submit' value='System Information'>

         <?php
         $view=mysqli_query($mysqli,"select * from phones");
         $no=1;
         while($row=mysqli_fetch_array($view)){

             ?>

     <div class="desc">
             <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label">IMEI </label>
                 <div class="col-sm-10">
                     :<?php echo $row['IMEI'];?>
                 </div>
             </div>
     </div>


       <div class="desc">
          <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">CLIENT </label>
                     <div class="col-sm-10">
                         :<?php echo $row['Client'];?>
                     </div>
          </div>
      </div>

         <?php
         }
         ?>

                      <!-- First Action -->
                      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>

                      	<div class="details">
                            <input type='submit' class='btn btn-info' name='submit' value='DONASI'>
                      		   <p>Secangkir Kopi selalu menemani saya mengembangkan SAGA, Donasi anda akan membantu saya untuk menyediakannya agar saya terus berkarya
                      		</p>
                            <p>REKENING BCA 3520428860 A/N MUHAMAD PRADESA</p>
							              <p>Donasi Pulsa juga boleh ke no : 082213148092/085718526769 </p>
                      	</div>

                          
               
                      	</div>

                          

                  


		
                        <!-- CALENDAR-->
                        
                      
                  </div><!-- /col-lg-3 -->
              </div><! --/row -->
<?php
}else{
    session_destroy();
    header('Location:index.php?status=Silahkan Login');
}
?>