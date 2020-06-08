
<?php 
include "header.php";
include "database.php";
include "functions.php";

function login_user($username, $password){//prisijungimo funkcija
    global $connection;//atsitempiam global connection kintamaji
    
        $result = mysqli_query($connection, "SELECT password FROM users WHERE username = '{$username}'");//pasiemam slaptazodi is duomenu bazes
        confirmQuery($result);

        $hash = mysqli_fetch_array($result);//isgaudanam masyva is uzklausos
        $hash = $hash['password'];//isgaunam slaptazodi is uzklausos
        
        if(password_verify($password,$hash)){//tikrinam ar ivestas slaptazodis tinka su slaptazodziu duomenu bazej
//prisijungt pavyko
            $query = "SELECT * FROM users WHERE username = '{$username}' ";
            $select_user_query = mysqli_query($connection, $query);
            confirmQuery($select_user_query);
            
            while($row = mysqli_fetch_array($select_user_query)){//pritaikom kintamiesiams user reiksmes
                $db_user_id = $row['user_id'];
                $db_user_role = $row['user_role'];
                $db_username = $row['username'];
                $db_password = $row['password'];
                $db_user_euro_currency = $row['user_euro_currency'];
                $db_user_kauko_currency = $row['user_kauko_currency'];
            }

        $_SESSION['user_id'] = $db_user_id;//sesijai priskirta kintamieji
        $_SESSION['username'] = $db_username;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_euro_currency'] = $db_user_euro_currency;
        $_SESSION['user_kauko_currency'] = $db_user_kauko_currency;
        
        // $_SESSION['password'] = $password;//zinau jog negalima laikyt passwordu sesijoje

        header("Location: ../index.php");//po prisijungimo persiunciama i index.php

        } 
        else {

            header("Location: ../index.php");//jeigu neiseina prisijungti vistiek persiunciama i index.php
        }
}

if(isset($_POST['login'])){//jeigu paspaudziama login mygtukas
global $connection;

    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($connection, $username);//jeigu kazkaip bando sql injectint, sustabdom tai
    $password = mysqli_real_escape_string($connection, $password);
    // echo $username;
    // echo $password;

    login_user($username, $password);//siunciam prisijungimo parametrus i prisijungimo funkcija
}



?>
