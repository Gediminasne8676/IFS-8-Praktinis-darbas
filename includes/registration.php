<?php 
include "functions.php";
include "database.php";
session_start();
ob_start();


function register_user($username, $password, $confirmpassword){//prisiregistravimo forma
   global $connection;
   if($password == $confirmpassword){//tikrinam ar abu slaptazodziai ivesti yra tokie patys
//prisiregistruoti isejo
      $password = password_hash($password, PASSWORD_BCRYPT, $options = array('cost' => 11));//uzhashinam slaptazodi

      $query = "INSERT into users (username, password)"; //su sql dedat y duomenu baze deda username ir uzhashinta slaptazodi
      $query .= "VALUES ('{$username}','{$password}')";
      $register_user_query = mysqli_query($connection, $query);//siunciam query
      confirmQuery($register_user_query);//tikrinam query ar veikia
      header("Location: ../index.php");//jei prisiregistruot pavyko grazinam i index.php puslapi
   }
   else {
      header("Location: ../index.php");//jei prisiregistruot nepavyko grazinam i index.php puslapi
   }
}


if(isset($_POST['register'])){//jei paspaudziamas input register
   if(!empty($_POST['rusername']) && !empty($_POST['rpassword']) && !empty($_POST['rconfirmpassword'])){//tikrinam ar visi laukai yra tusti
        $username = mysqli_real_escape_string($connection ,$_POST['rusername']);//nuo sql ataku apdorojam ivestus duomenis
        $password = mysqli_real_escape_string($connection ,$_POST['rpassword']);//nuo sql ataku apdorojam ivestus duomenis
        $confirmpassword = mysqli_real_escape_string($connection ,$_POST['rconfirmpassword']);//nuo sql ataku apdorojam ivestus duomenisx
        register_user($username, $password, $confirmpassword);//kvieciam prisiregistravimo funkcija su ivestais (username, password ir confirmpassword) parametrais
   }
   else {
      header("Location: ../index.php");//jeigu yra neivesta kazkoks laukelis, grazinam y index.php
   }
}
else {
   header("Location: ../index.php");//nera paspausta register mygutko bet ijungta registration.php puslapis grazinam vartotoja i index.php
}
?>