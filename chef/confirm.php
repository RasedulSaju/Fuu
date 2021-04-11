<?php
    /// received data collection
    // $_POST represents an associative array
    include '../config.php';
    if(isset($_GET['id']) && !empty($_GET['id']) ){
        $id=$_GET['id'];
        
        try{
            $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $query="Update home SET status='complete' WHERE homepage_no=$id";
            try{
                /// to insert data to corresponding database
                $dbcon->exec($query);
                
                /// if successful, forward the user to the user list page
                ?>
                    <script>window.location.assign('pending.php')</script>
                <?php
            }
            catch(PDOException $ex){
                /// if not successful, return back to add user page
                ?>
                    <script>window.location.assign('index.php')</script>
                <?php
            }
            
        }
        catch(PDOException $ex){
            ?>
                <script>window.location.assign('index.php')</script>
            <?php
        }
    }
    else{
        ?>
            <script>window.location.assign('index.php')</script>
    
        <?php
        
    }
?>