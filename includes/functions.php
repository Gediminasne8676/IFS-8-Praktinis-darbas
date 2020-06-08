<?php 


function doesuserExist(){//patikrinam ar yra toks vartotojas kaip user users lenteleje
 
    global $connection;
    
    if(connectionToTableStatus() == true){

        $query = "SELECT * FROM users WHERE username = 'user1'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);

        if(mysqli_num_rows($result)>=1){
            return true;
        }
        else if(mysqli_num_rows($result)<1)//jei nepavyksta prisijungimas
        {
            return false;
        }
    }
}

function connectionToTableStatus(){//patikrinam prisijungimo su lentele statusa ir grazinam reiksme true arba false
global $connection;
    if(connectionToDatabaseStatus() == true){

        $query = "SELECT * FROM users";
        $result = mysqli_query($connection, $query);

        if($result){
            return true;
        }
        else if(!$result)//jei nepavyksta prisijungimas
        {
            return false;
        }
    }
}

function connectionToDatabaseStatus(){//jeigu yra prisijungimas prie duomenu bazes tuomet grazinam true
global $connection;
    if(connectionToServerStatus() == true){
        if($connection){
            return true;
        }
        else if(!$connection){
            return false;
        }
    }
}

function connectionToServerStatus(){//patikrinam prisijungimo su serveriu statusa

    global $serverconnection;
    if($serverconnection){
        return true;
    }
    else if(!$serverconnection)//jei nepavyksta prisijungimas
    {
        return false;
    }
}


function loginStatus(){//pakeiciam login statuso mygtuko spalva, dadedam true arba false teksta mygtuke ir grazinam true arba false reiksme
    if(isset($_SESSION['username'])){
        echo "<script>changeButtonStatusTo('green','loginstatus');</script>";
        return true;
    }
    if(!isset($_SESSION['username'])){
        echo "<script>changeButtonStatusTo('red','loginstatus');</script>";
        return false;
    }
}


// function createuser(){//funkcija sukuria username = user, password = user vartotoja
// global $connection;
//     $username = "user";
//     $password = "user";
//     $password = password_hash($password, PASSWORD_BCRYPT, $options = array('cost' => 11));//uzcryptinam passworda

//     $query = "INSERT into users (username, password, user_role)"; 
//     $query .= "VALUES ('{$username}','{$password}',{'user'})";//siunciam useri i lentele

//     $create_user_query = mysqli_query($connection, $query);
//     confirmQuery($create_user_query);

//     if($create_user_query){
//     echo "Table with user (name = user, password = user) was created";//atspausdinama jog buvo sukurta lentele su useriu
//     }

// }

function create5Users(){
    global $connection;

    $user1pass = password_hash("user1", PASSWORD_BCRYPT, $options = array('cost' => 11));//uzcryptinam passworda
    $user2pass = password_hash("user2", PASSWORD_BCRYPT, $options = array('cost' => 11));//uzcryptinam passworda
    $user3pass = password_hash("user3", PASSWORD_BCRYPT, $options = array('cost' => 11));//uzcryptinam passworda
    $user4pass = password_hash("user4", PASSWORD_BCRYPT, $options = array('cost' => 11));//uzcryptinam passworda
    $user5pass = password_hash("user5", PASSWORD_BCRYPT, $options = array('cost' => 11));//uzcryptinam passworda


    $query =  "INSERT INTO `users` (`username`, `password`) VALUES 
    ('user1', '{$user1pass}'), 
    ('user2', '{$user2pass}'), 
    ('user3', '{$user3pass}'), 
    ('user4', '{$user4pass}'), 
    ('user5', '{$user5pass}')";

    $create_5user_query = mysqli_query($connection, $query);
    confirmQuery($create_5user_query);
}

function changeUser1Role(){
    global $connection;
    $query = "UPDATE `users` SET `user_role` = 'admin' WHERE `users`.`username` = 'user1'";
    $changeuser1role = mysqli_query($connection, $query);
    confirmQuery($changeuser1role);
}

function createTable(){//funkcija skirta sukurti lentele users
    global $connection;
        $query =  "CREATE TABLE users";//sukuriama lentele users
        $query .= "( `user_id` INT(3) NOT NULL AUTO_INCREMENT ,";// sukuriama lenteleje irasa user_id
        $query .= "`username` VARCHAR(255) NOT NULL , ";//irasas username
        $query .= "`password` VARCHAR(255) NOT NULL , ";//irasas password
        $query .= "PRIMARY KEY (`user_id`)) ENGINE = InnoDB ;";//pirminis raktas lenteles yra user_id
        
    
        $result = mysqli_query($connection, $query);//siuncama uzklausa
        confirmQuery($result);//tikrinama uzklausa

        $query = "ALTER TABLE `users` ADD `user_role` VARCHAR(255) NOT NULL DEFAULT 'subscriber' AFTER `password`;";
        $result = mysqli_query($connection, $query);//siuncama uzklausa
        confirmQuery($result);//tikrinama uzklausa

        $query = "ALTER TABLE `users` ADD `user_euro_currency` DOUBLE(11,2) NOT NULL DEFAULT '0' AFTER `user_role`";
        $result = mysqli_query($connection, $query);//siuncama uzklausa
        confirmQuery($result);//tikrinama uzklausa

        $query = "ALTER TABLE `users` ADD `user_kauko_currency` DOUBLE(11,2) NOT NULL DEFAULT '0' AFTER `user_euro_currency`";
        $result = mysqli_query($connection, $query);//siuncama uzklausa
        confirmQuery($result);//tikrinama uzklausa

        $query = "CREATE TABLE `KaukoCoinEx_IFS8_Gediminas_N`.`transactions` 
        ( `user_from` VARCHAR(255) NOT NULL ,  `user_to` VARCHAR(255) NOT NULL ,  `kauko_currency_amount` DOUBLE(11,2) 
        NOT NULL , `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB;";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);

    }

function createDataBase(){//funkcija skirta sukurti duomenu baze
    global $serverconnection;
        $result = mysqli_query($serverconnection,"CREATE DATABASE " . NAME);//kuriam duomenu baze
            if($result){//jeigu pavyksta sukurti duomenu baze
                echo "Database " . NAME .  " was created succesfully";//spausdinam jog sukureme duomenu baze
            }
            else if(!$result)
            {
                die("QUERY FAILED " . mysqli_error($serverconnection));
            }

    }
    


function confirmQuery($result){//funkcija skirta patikrint ar isejo issiust uzklausa
    global $connection;
        if(!$result)
        {
            die("QUERY FAILED " . mysqli_error($connection));
        }
}

function getUsersEuroAmount($user_id){
if(isConnectionUp()){
    global $connection;
    $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_array($result)){
        $result = $row['user_euro_currency'];
    }
    return $result;
}
}

function getUsersKaukoCoinAmount($user_id){
if(isConnectionUp()){
    global $connection;
    $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_array($result)){
        $result = $row['user_kauko_currency'];
    }
    return $result;
}
}

function isConnectionUp(){
    global $connection;
    if($connection){
        return true;
    }
    else if(!$connection){
        return false;
    }

}

?>