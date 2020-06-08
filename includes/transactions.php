<?php 

include "header.php";
include "database.php";
include "functions.php";


$username = $_SESSION['username'];
// $password = $_SESSION['password']; //zinau jog negalima <- daryti
$user_id = $_SESSION['user_id'];
$euro = $_SESSION['user_euro_currency'];
$kauko = $_SESSION['user_kauko_currency'];
$kaukocurrencybuyprice = 2.63;
$kaukocurrencysellprice = 2.43;

if(isset($_POST['addEuroCurrency'])){
    global $connection;
    $euroamount = mysqli_real_escape_string($connection, $_POST['eurocurrencyamounttoaddremove']);
    echo $euroamount;
    if(preg_match("/^[0-9.]+$/i",$euroamount)){
        if($euroamount >= 0.01 && $euroamount <= 10000){
            $query = "UPDATE `users` SET `user_euro_currency`= user_euro_currency + '{$euroamount}' WHERE `users`.`user_id` = '{$user_id}'";
            $result = mysqli_query($connection, $query);
            confirmQuery($result);
        }
        else{
            die('Suma gali buti NE mazesne nei 0.01 ir NE didesne nei 10000');
        }
    }
    else {
        die('Naudoti tik numerius ir simboli -> . (taskas)');
    }
    header("Location: ../index.php");
}

if(isset($_POST['removeEuroCurrency'])){
    global $connection;
    $euroamount = mysqli_real_escape_string($connection, $_POST['eurocurrencyamounttoaddremove']);
    echo $euroamount;
    if(preg_match("/^[0-9.]+$/i",$euroamount)){
        if($euroamount >= 0.01 && $euroamount <= 10000){
            $query = "UPDATE `users` SET `user_euro_currency`= user_euro_currency - '{$euroamount}' WHERE `users`.`user_id` = '{$user_id}'";
            $result = mysqli_query($connection, $query);
            confirmQuery($result);
        }
        else{
            die('Suma gali buti NE mazesne nei 0.01 ir NE didesne nei 10000');
        }
    }
    else {
        die('Naudoti tik numerius ir simboli -> . (taskas)');
    }
    header("Location: ../index.php");
}

if(isset($_POST['sellKaukoCoin'])){
    global $connection;
    $kaukocoinamount = mysqli_real_escape_string($connection, $_POST['kaukocoinamounttosell']);
    if(preg_match("/^[0-9.]+$/i",$kaukocoinamount)){
        if($kaukocoinamount >= 0.01 && $kaukocoinamount <= 10000){
            if(getUsersKaukoCoinAmount($_SESSION['user_id']) >= $kaukocoinamount){
                $euroamount = round($kaukocoinamount*2.43, 2);
                echo $euroamount . " " . getUsersEuroAmount($_SESSION['user_id']) . " ";
                    $query = "UPDATE `users` SET `user_euro_currency`= user_euro_currency + '{$euroamount}' WHERE `users`.`user_id` = '{$user_id}'";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);
                    $query = "UPDATE `users` SET `user_kauko_currency`= user_kauko_currency - '{$kaukocoinamount}' WHERE `users`.`user_id` = '{$user_id}'";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);
            }
            else {
                die('Jus neturite tiek KaukoCoin!');
            }
           
        }
        else{
            die('Suma gali buti NE mazesne nei 0.01 ir NE didesne nei 10000');
        }
    }
    else {
        die('Naudoti tik numerius ir simboli -> . (taskas)');
    }
    header("Location: ../index.php");
}

if(isset($_POST['buyKaukoCoin'])){
    global $connection;
    $kaukocoinamount = mysqli_real_escape_string($connection, $_POST['kaukocoinamounttobuy']);
    if(preg_match("/^[0-9.]+$/i",$kaukocoinamount)){
        if($kaukocoinamount >= 0.01 && $kaukocoinamount <= 10000){
            $euroamount = round($kaukocoinamount*2.63, 2);
            echo $euroamount . " " . getUsersEuroAmount($_SESSION['user_id']);
            if($euroamount < getUsersEuroAmount($_SESSION['user_id']) && getUsersEuroAmount($_SESSION['user_id']) >= 0.03 || $euroamount == getUsersEuroAmount($_SESSION['user_id'])){
                $query = "UPDATE `users` SET `user_euro_currency`= user_euro_currency - '{$euroamount}' WHERE `users`.`user_id` = '{$user_id}'";
                $result = mysqli_query($connection, $query);
                confirmQuery($result);
                $query = "UPDATE `users` SET `user_kauko_currency`= user_kauko_currency + '{$kaukocoinamount}' WHERE `users`.`user_id` = '{$user_id}'";
                $result = mysqli_query($connection, $query);
                confirmQuery($result);
            }
            else {
                die("Jus neturite pakankamai eurų");
            }
        }
        else{
            die('Suma gali buti NE mazesne nei 0.01 ir NE didesne nei 10000');
        }
    }
    else {
        die('Naudoti tik numerius ir simboli -> . (taskas)');
    }
    header("Location: ../index.php");
}

if(isset($_POST['sendKaukoCoin'])){
    global $connection;
    $kaukocoinamounttosend = mysqli_real_escape_string($connection, $_POST['kaukocoinamounttosend']);
    $kaukocoinamounttosendto = mysqli_real_escape_string($connection, $_POST['kaukocoinamounttosendto']);
    echo $kaukocoinamounttosend . " " . $kaukocoinamounttosendto . " " .  getUsersKaukoCoinAmount($_SESSION['user_id']);
    if($kaukocoinamounttosendto != $user_id){
        if($kaukocoinamounttosend <= getUsersKaukoCoinAmount($_SESSION['user_id'])){

            if($kaukocoinamounttosend >= 0.01 && $kaukocoinamounttosend <= 10000){

                $query = "SELECT * FROM users WHERE user_id = '{$kaukocoinamounttosendto}'";
                $result = mysqli_query($connection, $query);
                if(mysqli_num_rows($result) > 0){
                    $query = "UPDATE `users` SET `user_kauko_currency`= user_kauko_currency - '{$kaukocoinamounttosend}' WHERE `users`.`user_id` = '{$user_id}'";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);
            
                    $query = "UPDATE `users` SET `user_kauko_currency`= user_kauko_currency + '{$kaukocoinamounttosend}' WHERE `users`.`user_id` = '{$kaukocoinamounttosendto}'";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);

                    $query = "INSERT INTO `transactions` (`user_from`, `user_to`, `kauko_currency_amount`) VALUES ('$user_id', '{$kaukocoinamounttosendto}', '$kaukocoinamounttosend')";
                    $result = mysqli_query($connection, $query);
                    confirmQuery($result);
                }   
                else {
                    die('Neegzistuoja toks vartotojas kuriam norite issiusti KaukoCoin');
                }
            }
            else {
                die('Siunciama suma gali buti NE mazesne nei 0.01 ir NE didesne nei 10000');
            }
        } else{
            die('Jus neturite pakankamai KaukoCoin');
        }
    } else {
        die('Jus negalite sau issiusti KaukoCoin');
    }
    header("Location: ../index.php");
}

?>