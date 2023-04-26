<?php

if ($_GET)
{

include("db_conn.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($conn->query("DELETE FROM arabalar WHERE araba_id =".(int)$_GET['araba_id']))
{
    header("location:arabalar.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>
