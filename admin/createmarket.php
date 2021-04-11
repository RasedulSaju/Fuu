<?php
session_start();
    /// received data collection
    // $_POST represents an associative array
    include '../config.php';
    if(isset($_POST['menu']) && isset($_POST['cost']) && !empty($_POST['menu']) && !empty($_POST['cost']) ){
        
        $var1=$_POST['menu'];
        $var2=$_POST['cost'];
        
        try{
            $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            foreach($var1 as $m){
                
                $query="INSERT INTO raw_material (market_name, cost) VALUES('$m','$var2')";
            
                try{
                    /// to insert data to corresponding database

                        $dbcon->exec($query);


                    /// if successful, forward the user to the user list page
                    ?>
                        <script>window.location.assign('rawmaterials.php')</script>
                    <?php
                }
                catch(PDOException $ex){
                    /// if not successful, return back to add user page
                    ?>
                        <script>window.location.assign('addmarket.php')</script>
                    <?php
                }
            }
        }
        catch(PDOException $ex){
            ?>
                <script>window.location.assign('addmarket.php')</script>
            <?php
        }
    }
    else{
        ?>
            <script>window.location.assign('addmarket.php')</script>
        <?php
    }
?>