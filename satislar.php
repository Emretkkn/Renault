<?php include("db_conn.php"); ?>
<?php include_once("hometable.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>
<?php
$hometable = new Querys();
$q1 = array();
$q1 = $hometable->aracid();
$q2 = array();
$q2 = $hometable->bayi();

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
    <div id="sidebar-nav" class="sidebar">
      <div class="sidebar-scroll">
        <nav>
          <ul class="nav">
            <li><a href="anasayfa.php" class=""><i class="lnr lnr-home"></i> <span>Ana Sayfa</span></a></li>
            <li><a href="model.php" class=""><i class="lnr lnr-tag"></i> <span>Modeller</span></a></li>
            <li><a href="bayiler.php" class=""><i class="lnr lnr-apartment"></i> <span>Bayiler</span></a></li>
            <li><a href="arabalar.php" class=""><i class="lnr lnr-car"></i> <span>Araçlar</span></a></li>
            <li><a href="satislar.php" class="active"><i class="fa fa-money"></i> <span>Satış Yap</span></a></li>
            <li><a href="aysatis.php" class=""><i class="lnr lnr-chart-bars"></i> <span>Aylara Göre Satışlar</span></a></li>
            <li><a href="bolgesatis.php" class=""><i class="lnr lnr-chart-bars"></i> <span>Bölgelere Göre Satışlar</span></a></li>
            <li><a href="aracozellik.php" class=""><i class="lnr lnr-pie-chart"></i> <span>Pasta ve Çörek Grafikler</span></a></li>
            <li><a href="logout.php" class=""><i class="lnr lnr-exit"></i> <span>Çıkış</span></a></li>
          </ul>
        </nav>
      </div>
    </div>

    <div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
        <div class="col">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Satış Yap</h2>
						</div>
						<div class="panel-body">
             <div class="container-fluid">
              <div class="row">
                  <div class="col">
                 <form action="" method="post">
                  <table class="table">

                          <td>
                           Araç Kodu  :
                          </td>
                          <td>
                          <select id="cmbMake" name="id"
                              onchange="document.getElementById('selected_id').value=this.options[this.selectedIndex].text">
                              <?php foreach ($q1 as $key => $value) { ?>
                              <option value="<?php echo $value['araba_id']; ?>"><?php echo $value['araba_id'];?></option> <<?php } ?>
                          </select>
                          <input type="hidden" name="selected_id" id="selected_id" value="" />
                          </td></tr>

                          <td>
                           Bayi Adı  :
                          </td>
                          <td>
                          <select id="cmbMake" name="bayi"
                              onchange="document.getElementById('selected_bayi').value=this.options[this.selectedIndex].text">
                              <?php foreach ($q2 as $key => $value) { ?>
                              <option value="<?php echo $value['bayi_id']; ?>"><?php echo $value['ad'];?></option> <<?php } ?>
                          </select>
                          <input type="hidden" name="selected_bayi" id="selected_bayi" value="" />
                          </td></tr>



                          <tr>
                          <td></td>
                          <td><input class="btn btn-primary"  type="submit" value="Satış Yap"></td>
                          </tr>

                  </table>
              </form>
              <?php

              if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

                  // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
                  $id = $_POST['id'];
                  $bayi = $_POST['bayi'];



                  if ($id<>"" && $bayi<>"") {
                  // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.

                       // Veri ekleme sorgumuzu yazıyoruz.
                      if ($conn->query("INSERT INTO satislar (araba_id,bayi_id) VALUES ('$id','$bayi')"))
                      {
                          echo "Satış Yapıldı"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
                      }
                      else
                      {
                          echo "Hata oluştu";
                      }

                  }

              }

              ?>

              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->
							</div>
            </div>
             </div>
						</div>
					</div>
        </div>
          <div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Satışlar</h2>
						</div>
						<div class="panel-body">
              <div class="col">

                </div>
                <table class="table">

                    <tr>
                        <th>Bayi Adı</th>
                        <th>Şehir</th>
                        <th>Araç Kodu</th>
                        <th>Model</th>
                        <th>Motor</th>
                        <th>Renk</th>
                        <th>Üretim Yılı</th>
                        <th>Fiyat</th>
                        <th>Satış Tarihi</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("CALL satislar()"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $satis_id = $sonuc['satis_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $bayiad = $sonuc['bayiad'];
                $il = $sonuc['il'];
                $araba_id = $sonuc['araba_id'];
                $modelad = $sonuc['model_ad'];
                $motor = $sonuc['motor'];
                $renkad = $sonuc['renk_ad'];
                $yil = $sonuc['uretim_yili'];
                $fiyat = $sonuc['fiyat'];
                $tarih = $sonuc['satis_tarih'];

                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $bayiad; ?></td>
                        <td><?php echo $il; ?></td>
                        <td><?php echo $araba_id; ?></td>
                        <td><?php echo $modelad; ?></td>
                        <td><?php echo $motor; ?></td>
                        <td><?php echo $renkad; ?></td>
                        <td><?php echo $yil; ?></td>
                        <td><?php echo $fiyat; ?></td>
                        <td><?php echo $tarih; ?></td>
                        <td><a href="satissil.php?satis_id=<?php echo $satis_id; ?>" class="btn btn-danger">Sil</a></td>
                    </tr>

                <?php
                }
                // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                ?>

                </table>
            </div>
          </div>

					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
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
