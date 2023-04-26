<?php include("db_conn.php"); ?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="chart.min.js"></script>
  </head>
  <body>
    <form action="" method="post">
      <table class="table">
              <td>
               Satış Yapılan Ay  :
              </td>
              <td>
              <select id="cmbMake" name="aylar"
                  onchange="document.getElementById('selected_aylar').value=this.options[this.selectedIndex].text">
                  <option value="0">Ay Seçiniz</option>
                  <option value="1">Ocak</option>
                  <option value="2">Şubat</option>
                  <option value="3">Mart</option>
                  <option value="4">Nisan</option>
                  <option value="5">Mayıs</option>
                  <option value="6">Haziran</option>
                  <option value="7">Temmuz</option>
                  <option value="8">Ağustos</option>
                  <option value="9">Eylül</option>
                  <option value="10">Ekim</option>
                  <option value="11">Kasım</option>
                  <option value="12">Aralık</option>

              </select>
              <input type="hidden" name="selected_aylar" id="selected_aylar" value="" />
              </td></tr>

              <tr>
              <td></td>
              <td><input class="btn btn-primary"  type="submit" value="Getir"></td>
              </tr>

      </table>
    </form>

    <div>
      <canvas id="chart"></canvas>
    </div>

    <?php
    if ($_POST) {
      // code...
    $aylar = $_POST['aylar'];
    $bayisatis = $conn->query("SELECT bayiler.ad, COUNT(satislar.satis_id) AS satis
                               FROM bayiler INNER JOIN satislar ON bayiler.bayi_id=satislar.bayi_id
                               WHERE EXTRACT(MONTH FROM satislar.satis_tarih) IN('$aylar')
                               GROUP BY bayiler.ad");
     while ($deu = $bayisatis->fetch_assoc()){
       $ad[] = $deu['ad'];
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
  </body>
</html>
