<?php
    /// received data collection
    // $_POST represents an associative array
    include '../config.php';
    if(isset($_GET['id']) && isset($_POST['orderlist']) && isset($_POST['manager']) && isset($_POST['stts']) && !empty($_GET['id']) && !empty($_POST['orderlist']) && !empty($_POST['manager']) && !empty($_POST['stts']) ){
        $id=$_GET['id'];
        $var1=$_POST['orderlist'];
        $var2=$_POST['manager'];
        $var3=$_POST['stts'];
        
        try{
            $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $query="Update home SET file_name='$var1', manager_name='$var2', status='$var3' WHERE homepage_no=$id";
            try{
                /// to insert data to corresponding database
                $dbcon->exec($query);
                
                /// if successful, forward the user to the user list page
                ?>
                    <script>window.location.assign('orders.php')</script>
                <?php
            }
            catch(PDOException $ex){
                /// if not successful, return back to add user page
                ?>
                    <script>window.location.assign('editorder.php?id=<?php echo['$id']?>')</script>
                <?php
            }
            
        }
        catch(PDOException $ex){
            ?>
                <script>window.location.assign('editorder.php?id=<?php echo['$id']?>')</script>
            <?php
        }
    }
    else{
        ?>
            <script>window.location.assign('editorder.php?id=<?php echo['$id']?>')</script>
    
        <?php
        
    }
?>