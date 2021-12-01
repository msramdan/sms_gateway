<?php
error_reporting(0);
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'||$_SESSION['leveluser']=='2' )
{

?>

		
				<div class="row">
					<h3><i class="fa fa-angle-right"></i><?php echo $judul ?></h3>
					<div class="col-lg-12 col-md-12 mb">
						<div class="white-panel pn">
							<br>
							<br>
							<form name="myForm" id="myForm"  class="form-horizontal"  action="phonebook/exportpb.php" method="post" enctype="multipart/form-data">
								 <div class="form-group">
									<label class="col-sm-1 control-label">Group</label>
									<div class="col-sm-5">

										<select name="gp" value="" class="form-control" id="gp">
											<option>-- Pilih Group --</option>
											<?php
											$q = mysqli_query($mysqli,"select * from pbk_groups");

											while ($a = mysqli_fetch_array($q)){
												if ($a[1] ==$idgroup) {
													echo "<option value='$a[1]' selected>$a[0]</option>";
												} else {
													echo "<option value='$a[1]'>$a[0]</option>";
												}
											}
											?>
										</select>


									</div>
									<div class="col-sm-1">
									<input type="submit" class="btn btn-info btn-sm btn-next" name="submit" value="Export" />
									</div>
									
								
							</form>
						</div>
						
					</div>
					<a href="?id=pb" class="btn btn-danger pull-left ">
                        Kembali
					</a>
               </div>
			   </div>

          

<?php
}else{
    header('Location:index.php?status=Silahkan Login');
}
?>