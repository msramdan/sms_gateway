<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Grafik Polling SMS SAGA</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	  <link rel="shortcut icon" href="logosaga.png">
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT //SourceCode by AndezNET.com
      *********************************************************************************************************************************************************** -->
			<br>
      <br>
      <br>
      <br>
      <br>


	  	<div class="container">
		      
	  	    <div class="row">
		      <div id="responsecontainer"></div>
          </div>

		  
      </div>

      <?php 
        include "config/koneksi.php";
        //SourceCode by AndezNET.com
        $query = "SELECT * FROM tbl_set_pol";
        $hasil = mysqli_query($mysqli,$query);
        $row=mysqli_fetch_array($hasil);
        $querytotal=mysqli_query($mysqli,"SELECT sum(jumlah) as jum from tbl_polling");
        $rowtotal=mysqli_fetch_array($querytotal);
      ?>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.2.1.1.min.js"></script>
        <script src="assets/js/highcharts.js"></script>
        <!--   <script>
        $(document).ready(function() {
        $("#responsecontainer").load("prosess_polling.php");
        var refreshId = setInterval(function()
        {
        $("#responsecontainer").load('prosess_polling.php');
        }, 1000);
        });
        </script> -->


        <script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    chart: {
                        renderTo: 'responsecontainer',
                        type: 'column'
                    },
                    title: {
                        text: '<?php echo $row['judul']?>',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Total <?php echo $rowtotal['jum']?> SMS',
                        x: -20
                    },
                    xAxis: {
                        categories: []
                    },
                    yAxis: {
                        title: {
                            text: 'Jumlah'
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        headerFormat: '',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>:<b>{point.y}</b> data<br/>'
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 20,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y}'
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 100,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    series: []
                };
                $.getJSON("datatografik.php?all", function(json) {
                    options.xAxis.categories = json[0]['data']; //xAxis: {categories: []}
                    options.series[0] = json[1];
                    chart = new Highcharts.Chart(options);
                });
            });
        </script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>
	

  </body>
</html>
