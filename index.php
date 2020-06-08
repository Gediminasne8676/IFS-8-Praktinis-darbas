<?php 
include "includes/header.php";
include "includes/database.php";
include "includes/functions.php";
?>

<body>

    <div class="container" style="">

    <?php include "includes/databasepanel.php";?>

        <?php  include "includes/logintab.php"; ?>


        <?php

        if(isset($_SESSION['user_id'])){
            include "includes/currencytab.php";
        }
        ?>

        <?php 

        if($_SESSION['user_role'] == "admin"){
            include "includes/adminpanel.php";
        }

        ?>



    
    </div>

</body>

</html>