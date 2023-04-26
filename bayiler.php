<?php include("db_conn.php"); ?>
<?php include_once("hometable.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>
<?php
$hometable = new Querys();
$q1 = array();
$q1 = $hometable->iller();

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
            <li><a href="bayiler.php" class="active"><i class="lnr lnr-apartment"></i> <span>Bayiler</span></a></li>
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
        <div class="col">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Bayi Ekle</h2>
						</div>
						<div class="panel-body">
             <div class="container-fluid">
              <div class="row">
                  <div class="col">
                 <form action="" method="post">
                  <table class="table">
                          <td>Bayi Adı :</td>
                          <td><input name="ad" class="form-control" ></textarea></td>
                      </tr>

                          <td>
                           Bayinin Bulunduğu Şehir  :
                          </td>
                          <td>
                          <select id="cmbMake" name="plaka"
                              onchange="document.getElementById('selected_plaka').value=this.options[this.selectedIndex].text">
                              <?php foreach ($q1 as $key => $value) { ?>
                              <option value="<?php echo $value['plaka']; ?>"><?php echo $value['ad'];?></option> <<?php } ?>




                          </select>
                          <input type="hidden" name="selected_plaka" id="selected_plaka" value="" />
                          </td></tr>

                          <tr>
                          <td></td>
                          <td><input class="btn btn-primary"  type="submit" value="Bayi Ekle"></td>
                          </tr>

                  </table>
              </form>
              <?php

              if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

                  // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
                  $ad = $_POST['ad'];
                  $plaka = $_POST['plaka'];

              //yeni
                      $maker = $_POST['selected_plaka']; // get the selected text
                      $egeiki = $conn->query("SELECT * FROM iller WHERE ad='$maker'"); // Makale tablosundaki tüm verileri çekiyoruz.
                      while ($ege = $egeiki->fetch_assoc())
                      {
                      $plaka = $ege['plaka']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                      }


                  if ($ad<>"") {
                  // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.

                       // Veri ekleme sorgumuzu yazıyoruz.
                      if ($conn->query("INSERT INTO bayiler (ad,plaka) VALUES ('$ad','$plaka')"))
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
              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->
							</div>
            </div>
             </div>
						</div>
					</div>
        </div>
          <div class="panel panel-scrolling">
						<div class="panel-heading">
							<h2 class="panel-title"><b>Bayiler</h2>
						</div>
						<div class="panel-body">
              <div class="col">

                </div>
                <table class="table">

                    <tr>
                        <th>Bayi Kodu</th>
                        <th>Bayi Adı</th>
                        <th>Şehir</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("CALL bayiliste()"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {

                $bayi_id = $sonuc['bayi_id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $ad = $sonuc['ad'];
                $il = $sonuc['il'];

                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $bayi_id; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
                        <td><?php echo $ad; ?></td>
                        <td><?php echo $il; ?></td>
                        <td><a href="bayisil.php?bayi_id=<?php echo $bayi_id; ?>" class="btn btn-danger">Sil</a></td>
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
