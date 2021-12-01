<?php
session_start();
error_reporting(0);
include "config/koneksi.php";
include "config/page.php";

$id_user=$_SESSION['kode'];
$nm_user=$_SESSION['namauser'];
$photo=$_SESSION['photo'];
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )

{

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="SAGA">

    <title>SAGA 4</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">
    <link rel="stylesheet"  type="text/css" href="<?php echo $ambilcss1; ?>">
    <link rel="stylesheet"  type="text/css" href="<?php echo $ambilcss2; ?>">
	<link rel="shortcut icon" href="logosaga.png">
  <link href="assets/css/datepicker.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    <script src="assets/js/time.js" type="text/javascript"></script>
      

  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>SAGA 4</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->

                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li  class="dropdown" id="header_inbox_bar">
                        
                           
                       
                        
                    </li>
                    <span style="color:white" id="dates"><span id="the-day"><a>Hari, 00 Bulan 0000</a></span> <span id="the-time"><a>00:00:00</a></span> </span>
                </ul>
                <!--  notification end -->

            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">

                    <li><a class="logout" href="logout.php" onclick="return confirm('Apakah anda yakin ?');"><i class="glyphicon glyphicon-off"></i><span> Logout</span></a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
               
                  <li class="mt">
                      <a class="<?php echo $classmenu1 ?>" href="?id=home">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                 
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-envelope"></i>
                          <span>SMS</span>
                      </a>
                      <ul class="sub active">
                          <li><a data-toggle="modal" data-target="#myModal" href="" >Tulis Pesan</a></li>
                          <li><a  class="<?php echo $classmenu2 ?>" href="?id=inbox">Kotak Masuk</a></li>
                          <li><a  class="<?php echo $classmenu3 ?>" href="?id=outbox">Kotak Keluar</a></li>
                          <li><a  class="<?php echo $classmenu4 ?>" href="?id=sent">Pesan Terkirim</a></li>
                          <li><a data-toggle="modal" data-target="#modalsiaran" href="">Pesan Group</a></li>

                         
                          <li><a  class="<?php echo $classmenu4 ?>" href="?id=inboxspam">Pesan SPAM</a></li>
                          <li><a  class="<?php echo $classmenu4 ?>" href="?id=smsimport">SMS Import Xls</a></li>
                          
                          </li>

                          
                          

                      </ul>
                  </li>

            
                  <li class="active sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Kontak</span>
                      </a>
                      <ul class="sub">
                          <li><a class="<?php echo $classmenu8 ?>" href="?id=pb">Semua</a></li>
                          <li><a  class="<?php echo $classmenu9 ?>" href="?id=grp">Group</a></li>

                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-folder-o"></i>
                          <span>Auto SMS</span>
                      </a>
                      <ul class="sub active">
                          <li><a  class="<?php echo $classmenu9 ?>" href="?id=autoreply">Auto Reply</a></li>
                          <li><a  class="<?php echo $classmenu7 ?>" href="?id=autorespon">Auto Respon</a></li>
                          <li><a  class="<?php echo $classmenu2 ?>" href="?id=polling">Polling SMS</a></li>
                          <li><a class="<?php echo $classmenu5 ?>" href="?id=schedule">Pesan Terjadwal</a></li>
                          <li><a  class="<?php echo $classmenu7 ?>" href="?id=smsultah">SMS Ultah</a></li>
                      </ul>
                  </li>

				  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Settings</span>
                      </a>
                      <ul class="sub">
                          <!--<li><a data-toggle="modal" data-target="#modalcekpulsa" href="">Cek Pulsa</a></li>!-->
                          <li><a  href="?id=filterkata">Filter Kata</a></li>
                           <li><a  href="?id=setautosms">Auto Sms</a></li>
                          <li><a class="<?php echo $classmenu6 ?>" href="?id=profile">Profile</a></li>
                          
                      </ul>
                  </li>
				  
				         

                 

                  <li class="mt">

                      <a class="logout" href="logout.php" onclick="return confirm('Apakah anda yakin ?');">
                          <i class="glyphicon glyphicon-off"></i>
                          <span>logout</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

	 
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
	  
	       
          <section class="wrapper">
              <?php
              include "modal.php";
              include "config/koneksi.php";
              include "action.php";
              ?>
              <?php include $ambil; ?>

          </section>
   

      <!--main content end-->
      <!--footer start-->
    <!--   <div class="row">
      <footer class="site-footer">
          <div class="text-center">
              SAGA Ver 2.0 - www.andeznet.com
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
       </div> -->
      <!--footer end-->


    <!-- js placed at the end of the document so the pages load faster -->
    
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>
   <!--  <script src="assets/js/jquery.validate.min.js"></script> -->

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script> 
    <script src="assets/js/select2.min.js"></script> 
    <script src="assets/js/bootstrap-datepicker.min.js"></script>

    <!--script for this page-->

      <script src="<?php echo $ambiljs1; ?>"></script>
      <script src="<?php echo $ambiljs2; ?>"></script>
      <script src="<?php echo $ambiljs3; ?>"></script>
      <script src="<?php echo $ambiljs4; ?>"></script>
      <?php include $ambilfungsi; ?>


      <script type="text/javascript">
         $("#tgl_lahir").datepicker({
          autoclose: true,
          todayHighlight: true
          });
          function Ajax()
          {
              var
                  $http,
                  $self = arguments.callee;

              if (window.XMLHttpRequest) {
                  $http = new XMLHttpRequest();
              } else if (window.ActiveXObject) {
                  try {
                      $http = new ActiveXObject('Msxml2.XMLHTTP');
                  } catch(e) {
                      $http = new ActiveXObject('Microsoft.XMLHTTP');
                  }
              }

              if ($http) {
                  $http.onreadystatechange = function()
                  {
                      if (/4|^complete$/.test($http.readyState)) {
                          document.getElementById('header_inbox_bar').innerHTML = $http.responseText;

                          setTimeout(function(){$self();}, 10000);
                      }

                  };
                  $http.open('GET', 'cek_inbox.php' + '?' + new Date().getTime(), true);
                  $http.send(null);
              }
              else  {
                  document.getElementById('header_inbox_bar').innerHTML = $http.responseText;
              }

          }


      </script>

      <script type="text/javascript">
          setTimeout(function() {Ajax();}, 10000);

          $(document).ready(function(){
             $("#nohp").select2({
                
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


              $("#group").select2({
                
                // allowClear: true
                ajax: {
                  url: 'carigroup.php',
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

      

  </body>
</html>
<?php
}else{
    session_destroy();
    header('Location:index.php?status=Silahkan Login');
}
?>