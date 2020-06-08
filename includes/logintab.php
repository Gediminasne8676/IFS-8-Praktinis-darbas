
<div class="col-12 card border rounded shadow-lg p-0" style="margin-bottom: 50px;">


<div class="card-header">

    <nav>      
        <ul class="nav nav-tabs nav-fill card-header-tabs"  id="nav-tab" role="tablist">
                <a href="#" class="nav-item nav-link active" id="login-form-tab"  onclick="">Login</a>
                <?php if(!isset($_SESSION['username'])){ //jei yra prisijungta prie vartotojo, paslepti "registration" tab'ą ?> 
                <a href="#" class="nav-item nav-link" id="register-form-tab"  onclick="">Registration</a>
                <?php } ?>
        </ul>
    </nav>   

</div>



<div class="card-body card-content">

    <form action="includes/login.php" method="post" id="login-form">


        <?php if(!isset($_SESSION['user_id'])){ //Jeigu nera sukurta sesija (neprisijungta prie vartotojo) tuomet duoti prisijungimo laukelius ir mygtuka ?> 

        <div class="form-group">
                <p class="h1 text-center">Log in</p>
        </div>

        <div class="input-group form-group">
            <input type="text" class="form-control" placeholder="Username" name="username" id="name" onkeyup="lettersOnly(this)">
        </div>

        <div class="input-group form-group">                      
            <input type="password" class="form-control" placeholder="Password" name="password" id="pass" onkeyup="lettersOnly(this)">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="Login" name="login">
        </div>
        <?php } ?>



        <?php 
        if(isset($_SESSION['user_id'])){ //Jeigu yra sukurta sesija (prisijungta prie vartotojo) tuomet duoti atsijungimo mygtuka ?> 

        <div class="form-group">
                <p class="h1 text-center">Logged in as <?php echo $_SESSION['username'];?> <br>
                Euro currency : (<?php echo getUsersEuroAmount($_SESSION['user_id']);?>)<br>
                Kauko currency : (<?php echo getUsersKaukoCoinAmount($_SESSION['user_id']);?>)<br></p>
        </div>

        <div class="form-group">
                <p class="h1 text-center"></p>
        </div>

            <a href="./includes/logout.php"><input class="btn btn-danger btn-block" type="button" value="Logout"></a>

<br>
        <?php
        }
        ?>

    </form> 

    <?php if(!isset($_SESSION['user_id'])){ //jei yra nera prisijungta prie vartotojo, parodyti "registration" tab'ą tiesiog kaip neaktyvu t.y. su display none stilium ?> 
    <form action="includes/registration.php" method="post" id="register-form" style="display: none;">


        <div class="form-group">
                <p class="h1 text-center">Register</p>
        </div>

        <div class="input-group form-group">
            <input type="text" class="form-control" placeholder="Username" name="rusername" id="name" onkeyup="lettersOnly(this)">
        </div>

        <div class="input-group form-group">                      
            <input type="password" class="form-control" placeholder="Password" name="rpassword" id="pass" onkeyup="lettersOnly(this)">
        </div>

        <div class="input-group form-group">                      
            <input type="password" class="form-control" placeholder="Confirm Password" name="rconfirmpassword" id="confirmpass" onkeyup="lettersOnly(this)">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success btn-block" value="Register" name="register">
        </div>

    </form> 
    <?php } ?>

</div>


</div>

<script> 
$('#login-form-tab').click(function(e){//kuomen paspaudziama korteles navigationo mygtukas su id login-form-tab vykdyti funkcija
    $("#login-form").delay(100).fadeIn(100);//atverciam po 1 sekundes delay login korteles turiny
    $("#register-form").fadeOut(100);//per ta pirma sekunde paslepiam register forma
    $('#register-form-tab').removeClass('active');//pakeiciam korteles navigationo mygtuko klase (atspaudziam mygutka)
    $(this).addClass('active');//nuspaudziam korteles kita nav mygtuka
    e.preventDefault();//sustabdom evento vykyma
});

$('#register-form-tab').click(function(e){//kuomen paspaudziama korteles navigationo mygtukas su id register-form-tab vykdyti funkcija
    $("#register-form").delay(100).fadeIn(100);//atverciam po 1 sekundes delay register korteles turiny
    $("#login-form").fadeOut(100);//paslepiam per ta sekunde login forma
    $('#login-form-tab').removeClass('active');//pakeiciam korteles navigationo mygtuko klase (atspaudziam mygutka)
    $(this).addClass('active');//nuspaudziam korteles kita nav mygtuka
    e.preventDefault();//sustabdom evento vykyma
});
</script>