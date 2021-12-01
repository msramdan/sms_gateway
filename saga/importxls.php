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
						<form name="myForm" id="myForm"  class="form-horizontal" onSubmit="return validateForm()" action="#" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<div class="col-sm-9">
									<div class="col-xs-5">
									<input type="file" id="file" name="file" />
										</div>
									<input type="submit" class="btn btn-info btn-sm btn-next" name="submit" value="Import" />
									<a href="importtemplate.xls" class="btn btn-success btn-sm btn-next">Download</a>  Contoh format Excel
									 <a href="?id=import" class="btn btn-warning"><i class="fa fa-refresh"></i>Refresh</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				<a href="?id=pb" class="btn btn-danger pull-left ">
                        Kembali
					</a>
               </div>

                <?php
                if (isset($_POST['submit'])) {
                    ?>
                    <div id="progress">

                    </div>
                    <div id="info"></div>
                <?php
                }
                ?>

                <script type="text/javascript">
                    //    validasi form (hanya file .xls yang diijinkan)
                    function validateForm()
                    {
                        function hasExtension(inputID, exts) {
                            var fileName = document.getElementById(inputID).value;
                            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
                        }

                        if(!hasExtension('file', ['.xls'])){
                            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
                            return false;
                        }
                    }
                </script>
<div class="row">
<?php
require "config/excel_reader.php";


if(isset($_POST['submit'])){

    $target = basename($_FILES['file']['name']) ;
    move_uploaded_file($_FILES['file']['tmp_name'], $target);

    $data = new Spreadsheet_Excel_Reader($_FILES['file']['name'],false);


    $baris = $data->rowcount($sheet_index=0);

    for ($i=2; $i<=$baris; $i++)
    {

        $barisreal = $baris-1;
        $k = $i-1;

        $percent = intval($k/$barisreal * 100)."%";


        $grouid            	= $data->val($i, 1);
        $nama           	= $data->val($i, 2);
        $number   			= $data->val($i, 3);
        
        $query = "INSERT into pbk (GroupID,Name,Number)values('$grouid','$nama','$number')";
        $hasil = mysqli_query($mysqli,$query);
		
		if ($hasil > 0) {
			 echo '<script language="javascript">
        document.getElementById("progress").innerHTML="<div class=\'progress progress-mini progress-striped active\'><div class=\'progress-bar progress-bar-success\' style=\'width:'.$percent.'; \'>&nbsp;</div></div>";
        document.getElementById("info").innerHTML="<div class=\'alert alert-info\'>'.$k.' data berhasil diinsert ('.$percent.' selesai).</div>";
        </script>';

		} else {
		echo '<script language="javascript">
        document.getElementById("info").innerHTML="<div class=\'alert alert-danger\'>'.$k.' data gagal di import('.$percent.' selesai).</div>";
        </script>';
		}

        flush();



    }

    
}
?>

</div>

<?php
}else{
    header('Location:index.php?status=Silahkan Login');
}
?>