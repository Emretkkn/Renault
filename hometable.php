<?php

class Querys
{
  public function get()
  {
    include("db_conn.php");
    $sorgu2 = $conn->query("CALL encoksatilanaraclar()");
           $datas = array();
           while ($deu = $sorgu2->fetch_assoc()){
             $datas[] = $deu;
           }

          return $datas;
  }

  public function homeicon()
  {
    include("db_conn.php");
    $result1 = $conn->query("CALL sorgu1()");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }

  public function model()
  {
    include("db_conn.php");
    $result1 = $conn->query("CALL model_ad()");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }

  public function motor()
  {
    include("db_conn.php");
    $result1 = $conn->query("CALL motor()");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }

  public function renk()
  {
    include("db_conn.php");
    $result1 = $conn->query("SELECT * FROM renkler");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }

  public function bolge()
  {
    include("db_conn.php");
    $result1 = $conn->query("SELECT * FROM bolge");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }

  public function iller()
  {
    include("db_conn.php");
    $result1 = $conn->query("SELECT * FROM iller");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }

  public function aracid()
  {
    include("db_conn.php");
    $result1 = $conn->query("SELECT arabalar.araba_id FROM arabalar ORDER BY arabalar.araba_id");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }


  public function bayi()
  {
    include("db_conn.php");
    $result1 = $conn->query("SELECT bayiler.bayi_id, bayiler.ad FROM bayiler");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }

  public function satisyok()
  {
    include("db_conn.php");
    $result1 = $conn->query("CALL satisyapmayanlar()");
          $datas = array();
        while ($row1 = $result1->fetch_assoc()){
          $datas[] = $row1;
         }
        return $datas;
      }



}


?>
