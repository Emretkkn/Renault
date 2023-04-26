<?php

/* $adi="Can Aydın";

$yas=40; */

//echo $adi."</br>".$yas;

//Yorum Satırı

/*

Yorum

Satırı

*//*

//array

$isimler=array("Can","Ahmet","Mehmet");

//associative array

$arabalar=array("bir"=>"Mercedes","iki"=>"VW","uc"=>"Renault");

echo $isimler[0]." ".$arabalar["bir"]." kullanıyor";*/

/* $yil=2022;

$dogum_yil=1992;

$yas=$yil-$dogum_yil;

echo "Yaş:".$yas."</br>"; */

/* $a=10;

$b=20;

$a+=$b;

$a++;

echo $a;

 */

/* $a=10;

$b=0;

$sonuc=@($a/$b);

 */

/* $a=20;

if($a>10&&$a<15){

    echo "a değişkeni 10dan büyüktür";

}else if($a=10){

    echo "a değişkeni 10 a eşittir";

}else{

    echo "a değişkeni 10dan küçüktür";

}

if($a>10||$a<15){

    echo "a değişkeni 10dan büyüktür";

}else if($a=10){

    echo "a değişkeni 10 a eşittir";

}else{

    echo "a değişkeni 10dan küçüktür";

} */

/* $meyve="armut";

if($meyve=="karpuz"){

    echo "Karpuz seçildi";

}else if($meyve=="çilek"){

    echo "çilek";

}else if($meyve=="armut"){

    echo "armut";

}




switch($meyve){

    case 'karpuz':

        echo "karpuz seçildi";

        break;

    case 'çilek':

        echo "çilek";

        break;

    case  'armut':

        echo "armut";

        break;

} */

/* $sayi=1;

while($sayi<=10){

    echo $sayi."</br>";

    $sayi++;

} */

/* for($i=0;$i<5;$i++){

    echo $i;

} */

/* $meyveler=array("Elma","Armut","Portakal");

foreach($meyveler as $meyve){

    echo $meyve;

} */

/* for($i=0;$i<100;$i++){

    echo $i;

    if($i==25){

        break;

    }

} */

/*

$bolum="YBS";



function ekranabastir($x){

    echo $x;

}

ekranabastir($bolum);





function hosgeldin($x='Misafir'){

    echo "Hoşgeldin".$x;

}

hosgeldin(); */

/* function topla($sayi1,$sayi2){

    $sonuc=$sayi1+$sayi2;

    return $sonuc;

}

$hesapSonuc=topla(10,20);

print($hesapSonuc);



 */




/*  $isim="Ahmet";



 function selam(){

    global $isim;

    echo "Selam".$isim;

 }

 selam();





 $isim="Ahmet";



 function selam($x){



    echo "Selam".$x;

 }

 selam($isim); */





/*  function kisalt($x,$y){

    $uzunluk=strlen($x);

    if($uzunluk>$y){

        $x=substr($x,0,$y)."....";

    }

    return $x;

 }

$metin="Bugün hava çok güzel";

echo kisalt($metin,10);

  */

  /* $x="1234";

  if(strlen($x)<5){

    echo "Şifreniz en az 5 karakter olmalı";

  } */



?>
