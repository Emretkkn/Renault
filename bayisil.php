<?php

if ($_GET)
{

include("db_conn.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($conn->query("DELETE FROM bayiler WHERE bayi_id =".(int)$_GET['bayi_id']))
{
    header("location:bayiler.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>
