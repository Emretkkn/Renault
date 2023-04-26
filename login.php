<?php
session_start();
include "db_conn.php";
if (isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    if (empty($uname)) {
        header("Location: index.php?error=E-posta Gerekli");
        exit();
    }else if(empty($pass)){
        header("Location: index.php?error=Parola Gerekli");
        exit();
    }else{
        $sql = "SELECT * FROM admin WHERE eposta='$uname' AND sifre='$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['eposta'] === $uname && $row['sifre'] === $pass) {
                echo "Giriş Başarılı";
                $_SESSION['ad'] = $row['ad'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['eposta'] = $row['eposta'];
                header("Location: anasayfa.php");
                exit();
            }else{
                header("Location: index.php?error=E-posta veya Şifre Hatalı");
                exit();
            }
        }else{
            header("Location: index.php?error=E-posta veya Şifre Hatalı");
            exit();
        }
    }
}else{
    header("Location: index.php");
    exit();
}
