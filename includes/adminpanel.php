

  <div class="col-12 card border rounded shadow-lg p-2" style="margin-bottom: 50px;">




        <table class="table table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">User role</th>
                <th scope="col">KaukoCoin amount</th>
                <th scope="col">Euro amount</th>
                </tr>
            </thead>


            <tbody>
                <?php 
                $query = "SELECT * FROM users";
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_array($result)){
                    
                    echo "<tr>".
                    "<th scope='row'>". $row['user_id'] ."</th>".
                    "<td>". $row['username'] ."</td>".
                    "<td>". $row['password'] ."</td>".
                    "<td>". $row['user_role'] ."</td>".
                    "<td>". $row['user_kauko_currency'] ."</td>".
                    "<td>". $row['user_euro_currency'] ."</td>".
                    "</tr>";

                };
                ?>
            </tbody>
            
        </table>


  </div>


