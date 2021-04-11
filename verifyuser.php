<?php
    include 'config.php';

    if(isset($_POST['uname']) && isset($_POST['upass']) 
       && !empty($_POST['uname']) && !empty($_POST['upass'])){
        /// data receive
        /// database check email, password
        /// yes, forward homepage
        /// no, forward loginpage
        
        $var1=$_POST['uname'];
        $var2=md5($_POST['upass']);
        
        try{
            ///php-mysql 3 way. We will use PDO - PHP data object
            $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sqlquery="SELECT name, position FROM login WHERE name='$var1' and password='$var2'";
            //echo $sqlquery;
            try{
                $returnval=$dbcon->query($sqlquery);
				$table=$returnval->fetchAll();
                if($returnval->rowCount()==1){
					$usertype=$table[0]['position'];
                    ///one valid user found
                    session_start();
                    
                    $_SESSION['username']=$var1;
                    $_SESSION['role']=$usertype;
                    
                    //echo $var1;
                    //echo $usertype;
                    
					if($usertype=='admin'){
                    ?>
                        <script>window.location.assign('admin/');</script>
                    <?php
					}
                    else if($usertype=='manager'){
                    ?>
                        <script>window.location.assign('manager/');</script>
                    <?php
					}
                    else if($usertype=='chef'){
                    ?>
                        <script>window.location.assign('chef/');</script>
                    <?php
					}
                }
                else{
                    ///invalid user
                    ?>
                        <script>window.location.assign('login.php');</script>
                    <?php
                }
            }
            catch(PDOException $ex){
                ?>
                    <script>window.location.assign('login.php');</script>
                <?php
            }
        }
        catch(PDOException $ex){
            ?>
                <script>window.location.assign('login.php');</script>
            <?php
        }
        
    }
    else{
        ?>
            <script>window.location.assign('login.php');</script>
        <?php
    }
?>