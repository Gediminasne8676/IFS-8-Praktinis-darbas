<?php 
?>
<div class="col-12 card border rounded shadow-lg p-2" style="margin-bottom: 50px;">

  

    <?php 
    if(isset($_SESSION['user_id'])){ //Jeigu yra sukurta sesija (prisijungta prie vartotojo) tuomet duoti atsijungimo mygtuka 
    ?> 

<form method="post" action="includes/transactions.php">

        <p class="h1 text-center">Add/Remove Euro<br></p>
        <div class="input-group mb-12">
            <div class="input-group-prepend">
            <span class="input-group-text">Add €</span>
            </div>
            <input type="text" class="form-control" name="eurocurrencyamounttoaddremove" id="eurocurrencyamount" placeholder="min 0.01 max = 10000.00">
            <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" style="height:unset" name="addEuroCurrency">Add</button>
            <button class="btn btn-outline-secondary" type="submit" style="height:unset" name="removeEuroCurrency">Remove</button>
            </div>
        </div>

        <p class="h1 text-center">Sell KaukoCoin<br></p>

        <div class="input-group mb-12">
            <div class="input-group-prepend">
            <span class="input-group-text">Sell price : 2.43</span>
            </div>
            <input type="text" class="form-control" aria-label="" name="kaukocoinamounttosell" placeholder="min 0.01 max = 10000.00">
            <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" style="height:unset" name="sellKaukoCoin">Sell</button>
            </div>
        </div>

        <p class="h1 text-center">Buy KaukoCoin<br></p>

        <div class="input-group mb-12">
            <div class="input-group-prepend">
            <span class="input-group-text">Buy price : 2.63</span>
            </div>
            <input type="text" class="form-control" aria-label="" placeholder="min 0.01 max = 10000.00" name="kaukocoinamounttobuy">
            <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" style="height:unset" name="buyKaukoCoin">Buy</button>
            </div>
        </div>

        <p class="h1 text-center">Send KaukoCoin<br></p>

        <div class="input-group mb-12">
            <div class="input-group-prepend">
            <span class="input-group-text">Send from <?php echo $_SESSION['username'];?>(id-<?php echo $_SESSION['user_id'];?>) to</span>
            </div>
            <input type="text" class="form-control" aria-label="" placeholder="user's id" name="kaukocoinamounttosendto">
            <input type="text" class="form-control" aria-label="" placeholder="amount (min 0.01 max 10000)" name="kaukocoinamounttosend">
            <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" style="height:unset" name="sendKaukoCoin">Send</button>
            </div>
        </div>

</form> 
    <?php
    }
    ?>
</div>


