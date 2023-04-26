<?php include("db_conn.php"); ?>
<?php include_once("hometable.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>

 <?php

 $hometable = new Querys();
 $q1 = array();
 $q1 = $hometable->get();
 $q2 = array();
 $q2 = $hometable->homeicon();
 $q3 = array();
 $q3 = $hometable->satisyok();




?>


<!doctype html>
<html lang="tr">
<?php include_once 'ortak_sayfalar/header.php'; ?>
<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<?php include_once 'ortak_sayfalar/navbar.php'?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<?php include_once 'ortak_sayfalar/solmenu.php'; ?>
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><b>Renault Türkiye Karar Destek Sistemi Yönetici Paneli</h3>
							<p>Merhaba : <?php echo ucfirst($_SESSION['ad']) ?></p>
						</div>
            <div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-car"></i></span>
										<p>
											<span class="number"><?php foreach ($q2 as $key => $value) {  echo $value['satissayi']; ?></span>
											<span class="title">Toplam Satış</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-building"></i></span>
										<p>
											<span class="number"><?php echo $value['bayisayi']; ?></span>
											<span class="title">Bayi Sayısı</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-eye"></i></span>
										<p>
											<span class="number"><?php echo $value['yonetici']; ?></span>
											<span class="title">Yönetici Sayısı</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-line-chart"></i></span>
										<p>
											<span class="number"><?php echo $value['encokbayi']; ?></span>
											<span class="title">En Çok Satış Yapılan Bayi</span> <?php } ?>
										</p>
									</div>
								</div>
							</div>
						</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
          <div class="container-fluid">

            <!-- TABLE HOVER -->
            <div class="panel panel-headline">
              <div class="panel-heading">
                <h3 class="panel-title"><b>En çok Satılan 10 Araç</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped">

                    <tr>
                        <th>Model</th>
                        <th>Segment</th>
                        <th>Motor Tür</th>
                        <th>Motor Hacmi</th>
                        <th>Toplam Satış</th>
                    </tr>

                    <?php foreach ($q1 as $key => $value) {  ?>

                    <tr>
                        <td><?php echo $value['model_ad']; ?></td>
                        <td><?php echo $value['segment_ad']; ?></td>
                        <td><?php echo $value['tur_ad']; ?></td>
                        <td><?php echo $value['hacim'] ; ?></td>
                        <td><?php echo $value['sayi'] ; ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </div>
            </div>
            <!-- END TABLE HOVER -->
          </div>


          <div class="container-fluid">

            <!-- TABLE HOVER -->
            <div class="panel panel-headline">
              <div class="panel-heading">
                <h3 class="panel-title"><b>Hiç Satış Yapılmayan Bayiler</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped">

                    <tr>
                        <th>İl Adı</th>
                        <th>Bölge Adı</th>
                        <th>Bayi Adı</th>
                    </tr>

                    <?php foreach ($q3 as $key => $value) {  ?>

                    <tr>
                        <td><?php echo $value['il_ad']; ?></td>
                        <td><?php echo $value['bolge_ad']; ?></td>
                        <td><?php echo $value['bayi_Ad']; ?></td>
                    </tr>
                  <?php } ?>
                </table>
              </div>
            </div>
            <!-- END TABLE HOVER -->
          </div>


        <div class="container-fluid">
          <!-- TABLE HOVER -->
          <div class="panel panel-headline">
            <div class="panel-heading">
              <h3 class="panel-title"><b>İllere Göre Satış Sayıları</h3>
            </div>
              <div class="panel-body">
                <div class="container-fluid">
                  <canvas id="myChart"></canvas>
              </div>
            </div>
          </div>
          <!-- END TABLE HOVER -->
          </div>

          <div class="container-fluid">
            <!-- TABLE HOVER -->
            <div class="panel panel-headline">
              <div class="panel-heading">
                <h3 class="panel-title"><b>Modellere Göre Satış Sayıları</h3>
              </div>
                <div class="panel-body">
                  <div class="container-fluid">
                    <canvas id="myChart1"></canvas>
                  </div>
                </div>
              </div>
              <!-- END TABLE HOVER -->
          </div>
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  <?php   $sorgu2 = $conn->query("SELECT iller.ad, COUNT(satislar.satis_id) AS satis
                                  FROM iller LEFT JOIN bayiler ON iller.plaka=bayiler.plaka LEFT JOIN satislar ON bayiler.bayi_id=satislar.bayi_id
                                  GROUP BY iller.ad");
          while ($deu = $sorgu2->fetch_assoc()){
              $ilad[] = $deu['ad'];
              $ilsatis[] = $deu['satis'];
        }


        $sorgu3 = $conn->query("SELECT model.ad, COUNT(satislar.satis_id) AS satis
                                FROM model LEFT JOIN arabalar ON model.model_id=arabalar.model_id LEFT JOIN satislar ON arabalar.araba_id=satislar.araba_id
                                GROUP BY model.ad");
                while ($deu = $sorgu3->fetch_assoc()){
                    $modelad[] = $deu['ad'];
                    $modelsatis[] = $deu['satis'];
              }

    ?>
  const ctx = document.getElementById('myChart');
  const ctx1 = document.getElementById('myChart1');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($ilad); ?>,
      datasets: [{
        label: 'Son 12 ayda illere göre satış sayıları',
        data: <?php echo json_encode($ilsatis); ?>,
        borderWidth: 1.5,
        backgroundColor:'#fcad17',
        borderColor: '#000000',
        fill: true


      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($modelad); ?>,
      datasets: [{
        label: 'Son 12 ayda modellere göre satış sayıları',
        data: <?php echo json_encode($modelsatis); ?>,
        borderWidth: 1.5,
        backgroundColor:'#fcad17',
        borderColor: '#000000',
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
</body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
 ?>
