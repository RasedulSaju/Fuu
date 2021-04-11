<?php
session_start();
    /// received data collection
    // $_POST represents an associative array
    include '../config.php';
    if(isset($_POST['orderlist']) && !empty($_POST['orderlist']) ){
        
        $var1=$_POST['orderlist'];
        $var2=$_SESSION['username'];
        
        try{
            $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            foreach($var1 as $m){
				$query="INSERT INTO home (file_name, manager_name) VALUES('$m','$var2')";
				
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
						<script>window.location.assign('addorder.php')</script>
					<?php
				}
			}
            
        }
        catch(PDOException $ex){
            ?>
                <script>window.location.assign('addorder.php')</script>
            <?php
        }
    }
    else{
        ?>
            <script>window.location.assign('addorder.php')</script>
        <?php
    }
?>