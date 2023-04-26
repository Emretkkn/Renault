<?php include("db_conn.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
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
            <li><a href="model.php" class="active"><i class="lnr lnr-tag"></i> <span>Modeller</span></a></li>
            <li><a href="bayiler.php" class=""><i class="lnr lnr-apartment"></i> <span>Bayiler</span></a></li>
            <li><a href="arabalar.php" class=""><i class="lnr lnr-car"></i> <span>Araçlar</span></a></li>
            <li><a href="satislar.php" class=""><i class="fa fa-money"></i> <span>Satış Yap</span></a></li>
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
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Model Ekle</h2>
						</div>
						<div class="panel-body">
             <div class="row">
               <div class="col">
              <form action="" method="post">
                  <table class="table">
                          <td>Model :</td>
                          <td><input name="ad" class="form-control" ></textarea></td>
                      </tr>

                          <td>
                           Segment  :
                          </td>
                          <td>
                          <select id="cmbMake" name="segment_id"
                              onchange="document.getElementById('selected_segment').value=this.options[this.selectedIndex].text">
                              <option value="0">Segment Seçiniz</option>
                              <option value="1">SUV</option>
                              <option value="2">Hatchback</option>
                              <option value="3">Coupe</option>
                              <option value="4">Station Wagon</option>
                              <option value="5">Minivan</option>
                              <option value="6">Hybrid</option>
                              <option value="7">Elektrikli</option>
                              <option value="8">Sedan</option>
                              <option value="9">Crossover</option>

                          </select>
                          <input type="hidden" name="selected_segment" id="selected_segment" value="" />
                          </td></tr>

                          <tr>
                          <td></td>
                          <td><input class="btn btn-primary"  type="submit" value="Model Ekle"></td>
                          </tr>

                  </table>
              </form>

              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

              <?php

              if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

                  // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
                  $ad = $_POST['ad'];
                  $segment_id = $_POST['segment_id'];

              //yeni
                      $maker = $_POST['selected_segment']; // get the selected text
                      $egeiki = $conn->query("SELECT * FROM segment WHERE ad='$maker'"); // Makale tablosundaki tüm verileri çekiyoruz.
                      while ($ege = $egeiki->fetch_assoc())
                      {
                      $segment_id = $ege['segment_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                      }


                  if ($ad<>"") {
                  // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.

                       // Veri ekleme sorgumuzu yazıyoruz.
                      if ($conn->query("INSERT INTO model (ad,segment_id) VALUES ('$ad','$segment_id')"))
                      {
                          echo "Veri Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
                      }
                      else
                      {
                          echo "Hata oluştu";
                      }

                  }

              }

              ?>
              </div>
							</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
          <div class="container-fluid">

            <!-- TABLE HOVER -->
            <div class="row">
            <div class="panel panel-scrolling">
              <div class="panel-heading">
                <h2 class="panel-title"><b>Modeller</h2>
              </div>
              <div class="panel-body">
                <table class="table">

                    <tr>
                        <th>Model Kodu</th>
                        <th>Model</th>
                        <th>Segment</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("CALL modelliste()"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $model_id = $sonuc['model_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $ad = $sonuc['ad'];
                $segment_ad = $sonuc['segment_ad'];

                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $model_id; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
                        <td><?php echo $ad; ?></td>
                        <td><?php echo $segment_ad; ?></td>
                        <td><a href="sil.php?model_id=<?php echo $model_id; ?>" class="btn btn-danger">Sil</a></td>
                    </tr>

                <?php } ?>

                </table>
            </div>
          </div>
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
