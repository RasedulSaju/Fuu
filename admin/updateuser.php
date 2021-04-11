<?php
    /// received data collection
    // $_POST represents an associative array
    include '../config.php';
    if(isset($_GET['id']) && isset($_POST['uname']) && isset($_POST['uemail']) && isset($_POST['uphone']) && isset($_POST['upass']) && isset($_POST['upos']) && !empty($_GET['id']) && !empty($_POST['uname']) && !empty($_POST['uemail']) && !empty($_POST['uphone']) && !empty($_POST['upass']) && !empty($_POST['upos']) ){
        $id=$_GET['id'];
        $var1=$_POST['uname'];
        $var2=$_POST['uemail'];
        $var3=$_POST['uphone'];
        $var4=md5($_POST['upass']);
        $var5=$_POST['upos'];
        
        try{
            $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $query="Update login SET name='$var1', email='$var2', phone='$var3', password='$var4', position='$var5' WHERE login_no=$id";
            try{
                /// to insert data to corresponding database
                $dbcon->exec($query);
                
                /// if successful, forward the user to the user list page
                ?>
                    <script>window.location.assign('users.php')</script>
                <?php
            }
            catch(PDOException $ex){
                /// if not successful, return back to add user page
                ?>
                    <script>window.location.assign('edituser.php?id=<?php echo['$id']?>')</script>
                <?php
            }
            
        }
        catch(PDOException $ex){
            ?>
                <script>window.location.assign('edituser.php?id=<?php echo['$id']?>')</script>
            <?php
        }
    }
    else{
        ?>
            <script>window.location.assign('edituser.php?id=<?php echo['$id']?>')</script>
    
        <?php
        
    }
?>