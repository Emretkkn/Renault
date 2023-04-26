<?php include("db_conn.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>

 <?php  $sorgu2 = $conn->query("SELECT motor_tur.ad, ROUND(COUNT(satislar.satis_id)/(SELECT COUNT(satislar.satis_id) FROM satislar)*100,2) AS oran
                               FROM motor_tur LEFT JOIN motor ON motor_tur.tur_id=motor.tur_id LEFT JOIN arabalar ON arabalar.motor_id=motor.motor_id LEFT JOIN satislar ON arabalar.araba_id=satislar.araba_id
                               GROUP BY motor_tur.ad");
         while ($deu = $sorgu2->fetch_assoc()){
             $motorturad[] = $deu['ad'];
             $motorturoran[] = $deu['oran'];
       }

       $sorgu3 = $conn->query("SELECT segment.ad, ROUND(COUNT(satislar.satis_id)/(SELECT COUNT(satislar.satis_id) FROM satislar)*100,2) AS oran
                               FROM segment INNER JOIN model ON segment.segment_id=model.segment_id LEFT JOIN arabalar ON arabalar.model_id=model.model_id LEFT JOIN satislar ON arabalar.araba_id=satislar.araba_id
                               GROUP BY segment.ad");
               while ($deu = $sorgu3->fetch_assoc()){
                   $segmentad[] = $deu['ad'];
                   $segmentoran[] = $deu['oran'];
             }

       $sorgu4 = $conn->query("SELECT motor_hacim.hacim, ROUND(COUNT(satislar.satis_id)/(SELECT COUNT(satislar.satis_id) FROM satislar)*100,2) AS oran
                               FROM motor_hacim LEFT JOIN motor ON motor_hacim.hacim_id=motor.hacim_id LEFT JOIN arabalar ON arabalar.motor_id=motor.motor_id LEFT JOIN satislar ON arabalar.araba_id=satislar.araba_id
                               GROUP BY motor_hacim.hacim");
               while ($deu = $sorgu4->fetch_assoc()){
                   $hacimad[] = $deu['hacim'];
                   $hacimoran[] = $deu['oran'];
             }


       $sorgu4 = $conn->query("SELECT renkler.ad, ROUND(COUNT(satislar.satis_id)/(SELECT COUNT(satislar.satis_id) FROM satislar)*100,2) AS oran
                               FROM renkler LEFT JOIN arabalar ON arabalar.renk_id=renkler.renk_id LEFT JOIN satislar ON arabalar.araba_id=satislar.araba_id
                               GROUP BY renkler.ad");
               while ($deu = $sorgu4->fetch_assoc()){
                   $renkad[] = $deu['ad'];
                   $renkoran[] = $deu['oran'];
             }
 ?>
<!doctype html>
<html lang="tr">
<head>
	<title>Yönetim Paneli</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="renaulticon" sizes="76x76" href="assets/img/renault_ufak.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/renault.png">
</head>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<?php include_once 'ortak_sayfalar/navbar.php'?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
      <div class="sidebar-scroll">
        <nav>
          <ul class="nav">
            <li><a href="anasayfa.php" class=""><i class="lnr lnr-home"></i> <span>Ana Sayfa</span></a></li>
            <li><a href="model.php" class=""><i class="lnr lnr-tag"></i> <span>Modeller</span></a></li>
            <li><a href="bayiler.php" class=""><i class="lnr lnr-apartment"></i> <span>Bayiler</span></a></li>
            <li><a href="arabalar.php" class=""><i class="lnr lnr-car"></i> <span>Araçlar</span></a></li>
            <li><a href="satislar.php" class=""><i class="fa fa-money"></i> <span>Satış Yap</span></a></li>
            <li><a href="aysatis.php" class=""><i class="lnr lnr-chart-bars"></i> <span>Aylara Göre Satışlar</span></a></li>
            <li><a href="bolgesatis.php" class=""><i class="lnr lnr-chart-bars"></i> <span>Bölgelere Göre Satışlar</span></a></li>
            <li><a href="aracozellik.php" class="active"><i class="lnr lnr lnr-pie-chart"></i> <span>Pasta ve Çörek Grafikler</span></a></li>
            <li><a href="logout.php" class=""><i class="lnr lnr-exit"></i> <span>Çıkış</span></a></li>
          </ul>
        </nav>
      </div>
    </div>
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->

        <div class="col-md-6">
          <div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><b>Motor Türlerinin Toplam Satışa Oranı</h3>
						</div>
						<div class="panel-body">
              <canvas id="Chart1"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><b>Segmentlerin Toplam Satışa Oranı</h3>
						</div>
						<div class="panel-body">
                <canvas id="Chart"></canvas>
						</div>
					</div>
        </div>

        <div class="col-md-6">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><b>Motor Hacimlerinin Toplam Satışa Oranı</h3>
						</div>
						<div class="panel-body">
                <canvas id="Chart2"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><b>Araç Renklerinin Toplam Satışa Oranı</h3>
						</div>
						<div class="panel-body">
                <canvas id="Chart3"></canvas>
            </div>
          </div>
        </div>

					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
			<?php include_once 'ortak_sayfalar/footer.php'; ?>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/scripts/renault-common.js"></script>
  <script>
  const data = {
    labels: <?php echo json_encode($motorturad); ?>,
    datasets: [{
      label: 'Satış Oranı',
      data: <?php echo json_encode($motorturoran); ?>,
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)'
      ],
      hoverOffset: 4
    }]
    };

    const data1 = {
      labels: <?php echo json_encode($segmentad); ?>,
      datasets: [{
        label: 'Satış Oranı',
        data: <?php echo json_encode($segmentoran); ?>,
        backgroundColor: [
          'rgb(236, 133, 98, 1)',
          'rgb(238, 175, 103, 1)',
          'rgb(238, 236, 103, 1)',
          'rgb(153, 220, 117, 1)',
          'rgb(117, 220, 201, 1)',
          'rgb(107, 107, 216, 1)',
          'rgb(107, 107, 111, 1)',
          'rgb(0, 173, 255, 1)',

        ],
        hoverOffset: 4
      }]
      };

      const data2 = {
        labels: <?php echo json_encode($hacimad); ?>,
        datasets: [{
          label: 'Satış Oranı',
          data: <?php echo json_encode($hacimoran); ?>,
          backgroundColor: [
            'rgb(255, 38, 0, 1)',
            'rgb(255, 203, 0, 1)',
            'rgb(89, 255, 0, 1)',
            'rgb(0, 178, 255, 1)',
            'rgb(171, 0, 255, 1)',
            'rgb(107, 107, 216, 1)',

          ],
          hoverOffset: 4
        }]
        };


        const data3 = {
          labels: <?php echo json_encode($renkad); ?>,
          datasets: [{
            label: 'Satış Oranı',
            data: <?php echo json_encode($renkoran); ?>,
            backgroundColor: [
              'rgb(255 204 153)',
              'rgb(245, 245, 245 )',
              'rgb(28 15 69)',
              'rgb(54 54 54)',
              'rgb(181 181 181)',
              'rgb(139 69 19)',
              'rgb(139 0 0)',
              'rgb(0 0 139)',
              'rgb(28 134 238)',
              'rgb(125 38 205)',
              'rgb(255 105 180)',
              'rgb(255 255 0)',
              'rgb(0 0 0)',
              'rgb(221 196 136)',
              'rgb(0 238 238)',
              'rgb(255 127 0)',
              'rgb(0 238 0)',
              
            ],
            hoverOffset: 4
          }]
          };


    const config = {
      type: 'pie',
      data: data,
    };

    const config1 = {
      type: 'pie',
      data: data1,
    };

    const config2 = {
      type: 'doughnut',
      data: data2,
    };

    const config3 = {
      type: 'doughnut',
      data: data3,
    };


    const myChart = new Chart(
      document.getElementById('Chart1'),
      config
    );

    const myChart1 = new Chart(
      document.getElementById('Chart'),
      config1
    );

    const myChart2 = new Chart(
      document.getElementById('Chart2'),
      config2
    );

    const myChart3 = new Chart(
      document.getElementById('Chart3'),
      config3
    );
  </script>
</body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
 ?>
