<?php include("db_conn.php");
$sorgu2 = $conn->query("CALL bolgesatis()");
      while ($deu = $sorgu2->fetch_assoc()){
          $bolgeisim[] = $deu['ad'];
          $bolgesatis[] = $deu['bolgesatis'];
}
?>

<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <?php include_once 'ortak_sayfalar/header.php'; ?>
  <body>

    <div><canvas id="myChart"></canvas></div>




    <script src="assets/vendor/jquery/jquery.min.js"></script>
  	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
  	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
  	<script src="assets/scripts/renault-common.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($bolgeisim); ?>,
        datasets: [{
          label: 'Son 12 ayda bölgelere göre satış sayıları',
          data: <?php echo json_encode($bolgesatis); ?>,
          borderWidth: 1
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
  </body>
</html>
