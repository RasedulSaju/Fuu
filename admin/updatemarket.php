<?php
    /// received data collection
    // $_POST represents an associative array
    include '../config.php';
    if(isset($_GET['id']) && isset($_POST['menu']) && isset($_POST['cost']) && !empty($_GET['id']) && !empty($_POST['menu']) && !empty($_POST['cost']) ){
        $id=$_GET['id'];
        $var1=$_POST['menu'];
        $var2=$_POST['cost'];
        
        try{
            $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $query="Update raw_material SET market_name='$var1', cost='$var2' WHERE raw_no=$id";
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
                    <script>window.location.assign('editmarket.php?id=<?php echo['$id']?>')</script>
                <?php
            }
            
        }
        catch(PDOException $ex){
            ?>
                <script>window.location.assign('editmarket.php?id=<?php echo['$id']?>')</script>
            <?php
        }
    }
    else{
        ?>
            <script>window.location.assign('editmarket.php?id=<?php echo['$id']?>')</script>
        <?php
    }
?>