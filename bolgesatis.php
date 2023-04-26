<?php include("db_conn.php"); ?>
<?php include_once("hometable.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>

 <?php
 $hometable = new Querys();
 $q1 = array();
 $q1 = $hometable->bolge();
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
            <li><a href="bolgesatis.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>Bölgelere Göre Satışlar</span></a></li>
            <li><a href="aracozellik.php" class=""><i class="lnr lnr-pie-chart"></i> <span>Pasta ve Çörek Grafikler</span></a></li>
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
          <div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"><b>Bölgelere Göre İllerin Satış Sayıları</h3>
						</div>
						<div class="panel-body">

                <form action="" method="post">
                  <table class="table">
                          <td>
                           Satış Yapılan Bölge  :
                          </td>
                          <td>
                          <select id="cmbMake" name="bolge"
                              onchange="document.getElementById('selected_bolge').value=this.options[this.selectedIndex].text">
                              <option value="0">Bölge Seçiniz</option>
                              <?php foreach ($q1 as $key => $value) { ?>
                              <option value="<?php echo $value['bolge_id'];?>"><?php echo $value['bolge_ad'];?></option><?php } ?>
                          </select>
                          <input type="hidden" name="selected_bolge" id="selected_bolge" value="" />
                          </td></tr>

                          <tr>
                          <td></td>
                          <td><input class="btn btn-primary"  type="submit" value="Getir"></td>
                          </tr>

                  </table>
                </form>
            </div>
          </div>

					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"></h3>
						</div>
						<div class="panel-body">
              <div class="container-fluid">
                <canvas id="chart"></canvas>
              </div>
             <?php
             if ($_POST) {
               // code...
             $bolge = $_POST['bolge'];
             $bayisatis = $conn->query("SELECT iller.ad AS il, COUNT(satislar.satis_id) AS satis
                                        FROM arabalar INNER JOIN satislar ON arabalar.araba_id=satislar.araba_id
                                        LEFT JOIN bayiler ON satislar.bayi_id=bayiler.bayi_id LEFT JOIN iller ON bayiler.plaka=iller.plaka INNER JOIN bolge ON iller.bolge_id=bolge.bolge_id
                                        WHERE bolge.bolge_id IN('$bolge')
                                        GROUP BY iller.ad");

              while ($deu = $bayisatis->fetch_assoc()){
                $ad[] = $deu['il'];
                $satis[] = $deu['satis'];
              }
             ?>
              <script type="text/javascript">
              const ctx = document.getElementById('chart');
              const chartClass = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: <?php echo json_encode($ad); ?>,
                  datasets: [{
                    label: 'Satış Sayısı',
                    data: <?php echo json_encode($satis); ?>,
                    backgroundColor:'#fcad17',
                    borderWidth: 1.5,
                    borderColor: '#000000',
                  }]
                },
                options: {
                  indexAxis: 'x',
                }
              });
              </script>
            <?php }else {

            } ?>
            <script type="text/javascript">
            const ctx = document.getElementById('chart');
            const chartClass = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: [],
                datasets: [{
                  label: 'Satış Sayısı',
                  data: [0,0,0,0,0],
                  backgroundColor:'#fcad17',
                  borderWidth: 1.5,
                  borderColor: '#000000',
                }]
              },
              options: {
                indexAxis: 'x',
              }
            });
            </script>


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
</body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
 ?>
