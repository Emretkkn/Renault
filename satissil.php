<?php

if ($_GET)
{

include("db_conn.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($conn->query("DELETE FROM satislar WHERE satis_id =".(int)$_GET['satis_id']))
{
    header("location:satislar.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>
