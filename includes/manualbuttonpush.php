<?php 
include "header.php";
include "database.php";
include "functions.php";
?>

<body>

    <div class="container" style="">


        <?php

// $query = "DROP DATABASE " . NAME;
//     $result = mysqli_query($connection, $query);
//     confirmQuery($result);


// $query = "DELETE FROM users WHERE username = 'user'";
// $result = mysqli_query($connection, $query);
// confirmQuery($result);

// $query = "DROP TABLE users";
//     $result = mysqli_query($connection, $query);
//     confirmQuery($result);



// createDatabase();
        // createTable();
        // create5Users();
        // changeUser1Role();

    echo doesuserExist()

        

        ?>

 <div class="col-12 col-xl-3 p-1 border rounded shadow">
                            <form action="managedatabase.php" method="post" class="col-12" class="form-control" style="padding: 0px;">
                            <button type="submit" class="btn btn-primary btn-block" style="" name="adminreborn">Create 5 users (1 admin)</button>
                            </form>
                        </div>
    </div>

</body>

</html>