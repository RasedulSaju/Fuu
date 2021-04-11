<?php
session_start();
    /// received data collection
    // $_POST represents an associative array
    include '../config.php';

    if(isset($_SESSION['username']) && isset($_POST['uemail']) && isset($_POST['uphone']) && isset($_POST['upass']) && !empty($_SESSION['username']) && !empty($_POST['uemail']) && !empty($_POST['uphone']) && !empty($_POST['upass'])){
        
        $name=$_SESSION['username'];
        $var2=$_POST['uemail'];
        $var3=$_POST['uphone'];
        $var4=md5($_POST['upass']);
        
        try{
            $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $query="Update login SET email='$var2', phone='$var3', password='$var4' WHERE name='$name'";
            try{
                /// to insert data to corresponding database
                $dbcon->exec($query);
                
                /// if successful, forward the user to the user list page
                ?>
                    <script>window.location.assign('index.php')</script>
                <?php
            }
            catch(PDOException $ex){
                /// if not successful, return back to add user page
                ?>
                    <script>window.location.assign('editprofile.php')</script>
                <?php
            }
            
        }
        catch(PDOException $ex){
            ?>
                <script>window.location.assign('editprofile.php')</script>
            <?php
        }
    }
    else{
        ?>
            <script>window.location.assign('editprofile.php')</script>
    
        <?php
        
    }
?>