<?php 
include "functions.php";
include "database.php";
session_start();//pradedam sesija
ob_start();

    $_SESSION['user_id'] = null;//pritaikom sesijos kintamiesiams tuscius laukus
    $_SESSION['username'] = null;
    $_SESSION['password'] = null;
    $_SESSION['user_role'] = null;    
    $_SESSION['user_euro_currency'] = null;
    $_SESSION['user_kauko_currency'] = null;

    header("Location: ../index.php");//graziname y index.php puslapi

?>
