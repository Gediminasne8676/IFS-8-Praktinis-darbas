

<?php 
$db['host'] = 'localhost';
$db['user'] = 'root';
$db['pass'] = '';
$db['name'] = 'KaukoCoinEx_IFS8_Gediminas_N';

foreach($db as $key => $value)//paema masyvo kiekviena indeksa kaip kintamaji($key) ir i jy ideda masyvo indekso verte($value)
{
    define(//padaro $key reiksme konstanta su $value reiksme
            strtoupper($key) //padaro string reiksme y didziasias raides
                            ,$value);
}

$serverconnection = mysqli_connect(HOST,USER,PASS);//sukuriam serverio prisijungimo kintamajy
if(!$serverconnection)//jei nepavyksta prisijungimas
{
    echo "<br>Connection to the server FAILED : " . mysqli_error($serverconnection);
}
else{ //jei pavyksta prisijungimas prie serverio
    // echo "<br>Connection to server success"; //atspauzdinam i console jog pavyko prisijungti prie serverio

    $connection = mysqli_connect(HOST,USER,PASS,NAME);//bandom prisijungti prie duomenu bazes
    if($connection){
        // echo "<br>Connection to database success";//jeigu pavyksta duomenu bazes prisijungimas atspausdinam i console
    }
    else if(!$connection){// jei nepavyksta prisijungti prie duomenu bazes
        echo "<br>SUKURKITE DUOMENU BAZE!!! Yra mygtukas melynas 'Create Database' zemiau prisijungimo skilties";
    }
}
?>