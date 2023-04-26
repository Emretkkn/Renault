<?php

if ($_GET)
{

include("db_conn.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($conn->query("DELETE FROM model WHERE model_id =".(int)$_GET['model_id']))
{
    header("location:model.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>
