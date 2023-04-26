<?php include("db_conn.php"); ?>
<?php include_once("hometable.php"); ?>
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['ad'])) {
 ?>
<?php
$hometable = new Querys();
$q1 = array();
$q1 = $hometable->model();
$q2 = array();
$q2 = $hometable->motor();
$q3 = array();
$q3 = $hometable->renk();

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
            <li><a href="arabalar.php" class="active"><i class="lnr lnr-car"></i> <span>Araçlar</span></a></li>
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
							<h2 class="panel-title"><b>Araç Oluştur</h2>
						</div>
						<div class="panel-body">
              <div class="col">
              <form action="" method="post">
                  <table class="table">
                    <td>
                     Model  :
                    </td>
                    <td>
                    <select id="cmbMake" name="model" onchange="document.getElementById('selected_model').value=this.options[this.selectedIndex].text">
                      <?php foreach ($q1 as $key => $value) { ?>
                        <option value="<?php echo $value['model_id'];?>"><?php echo $value['ad'];?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_model" id="selected_model" value="" />
                    </td></tr>
                    <td>
                     Motor  :
                    </td>
                    <td>
                    <select id="cmbMake" name="motor" onchange="document.getElementById('selected_motor').value=this.options[this.selectedIndex].text">
                      <?php foreach ($q2 as $key => $value) { ?>
                        <option value="<?php echo $value['motor_id'];?>"><?php echo $value['ad']." ".$value['hacim'];?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_motor" id="selected_motor" value="" />
                    </td></tr>
                    <td>
                     Renk  :
                    </td>
                    <td>
                    <select id="cmbMake" name="renk" onchange="document.getElementById('selected_renk').value=this.options[this.selectedIndex].text">
                      <?php foreach ($q3 as $key => $value) { ?>
                        <option value="<?php echo $value['renk_id'];?>"><?php echo $value['ad']?></option> <?php } ?>
                    </select>
                    <input type="hidden" name="selected_renk" id="selected_renk" value="" />
                    </td></tr>

                    <td>Üretim Yılı :</td>
                    <td><input name="yıl" type="number" min="2010" max="2022" class="form-control" ></textarea></td>
                    </tr>
                    <td>Fiyat :</td>
                    <td><input name="fiyat" type="number" min="150000" max="5000000" class="form-control" ></textarea></td>
                    </tr>
                    <td></td>
                    <td><input class="btn btn-primary"  type="submit" value="Araç Ekle"></td>
                    </tr>

                  </table>
              </form>

              <!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

              <?php

              if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

                  // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
                  $model = $_POST['model'];
                  $motor = $_POST['motor'];
                  $renk = $_POST['renk'];
                  $yıl = $_POST['yıl'];
                  $fiyat = $_POST['fiyat'];



                  if ($model<>"" && $motor<>"" && $renk<>"" && $yıl<>"" && $fiyat<>"") {
                  // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.

                       // Veri ekleme sorgumuzu yazıyoruz.
                      if ($conn->query("INSERT INTO arabalar (uretim_yili,fiyat,model_id,motor_id,renk_id) VALUES ('$yıl','$fiyat','$model','$motor','$renk')"))
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
        </div>

          <div class="container-fluid">

            <!-- TABLE HOVER -->

            <div class="panel panel-scrolling">
              <div class="panel-heading">
                <h2 class="panel-title"><b>Araçlar</h2>
              </div>
              <div class="panel-body">
                <div class="container-fluid">
                <table class="table">

                    <tr>
                        <th>Araç Kodu</th>
                        <th>Model</th>
                        <th>Motor</th>
                        <th>Renk</th>
                        <th>Yıl</th>
                        <th>Fiyat</th>
                        <th>Sil</th>
                    </tr>

                <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

                <?php



                $sorgu = $conn->query("CALL arabalar()"); // Model tablosundaki tüm verileri çekiyoruz.

                while ($sonuc = $sorgu->fetch_assoc()) {
                $ida = $sonuc['araba_id'];
                $modela = $sonuc['model_ad']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $motora = $sonuc['motor'];
                $renka = $sonuc['renk_ad']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $yila = $sonuc['uretim_yili'];
                $fiyata = $sonuc['fiyat']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.


                // While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                    <tr>
                        <td><?php echo $ida; ?></td>
                        <td><?php echo $modela; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
                        <td><?php echo $motora; ?></td>
                        <td><?php echo $renka; ?></td>
                        <td><?php echo $yila; ?></td>
                        <td><?php echo $fiyata; ?></td>
                        <td><a href="arabasil.php?araba_id=<?php echo $ida; ?>" class="btn btn-danger">Sil</a></td>
                    </tr>

                <?php
                }
                // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
                ?>

                </table>
            </div>
          </div>
					<!-- END OVERVIEW -->

            <!-- TABLE HOVER -->

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
