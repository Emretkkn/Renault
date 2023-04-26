<?php
session_start();
include "db_conn.php";
if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['firstname'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $fname = validate($_POST['firstname']);
    $postakontrol= mysqli_query($conn,"SELECT * FROM admin WHERE eposta='$uname'");
    $postakontrol2= mysqli_fetch_array($postakontrol);

    if (empty($uname)) {
        header("Location: kayit.php?error=E-posta Gerekli");
        exit();
    }else if(empty($pass)){
        header("Location: kayit.php?error=Parola Gerekli");
        exit();
    }else if(empty($fname)){
        header("Location: kayit.php?error=İsim Gerekli");
        exit();
    }else if($postakontrol2 > 0){
        header("Location: kayit.php?error=Bu E-posta Zaten Kullanılıyor");
        exit();
    }else{
      if ($conn->query("INSERT INTO admin (ad,sifre,eposta) VALUES ('$fname','$pass','$uname')"))
      {
          header("Location: index.php");
      }
      else
      {
          echo "Bu Kullanıcı Zaten Var";
      }
    }
}else{
    header("Location: kayit.php");
    exit();
}
