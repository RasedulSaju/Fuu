<?php
session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username']) && !empty($_SESSION['role'])){
        if($_SESSION['role']=='chef'){
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Search Order | Chef | Fuu</title>
                <link href="../logo.jpg" rel="icon"/>
            </head>
            <body>
                <h3>Search Fuu Order Including <q><b><?php echo $_GET['param1'] ?></b></q></h3>
                <a href="pending.php">Go Back</a> | <a href="../logout.php">Log Out</a>
                <?php
                    include'../config.php';
                    if(isset($_GET['param1']) && !empty($_GET['param1'])){
                    ?> 
                        <table>
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Order List</th> 
                                    <th>Created by</th> 
                                    <th>Status</th>
                                    <th>Order Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    try{
                                        $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
                                        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        
                                        $searchval=$_GET['param1'];
                                        $sqlquery="";
                                        if(!empty($searchval)){
                                            $sqlquery="SELECT * FROM home where file_name LIKE '%$searchval%' AND status='pending'";
                                        }
                                        
                                        
                                        try{
                                            $returnval=$dbcon->query($sqlquery); ///PDO Statement
                                            
                                            $productstable=$returnval->fetchAll();
                                            
                                            foreach($productstable as $row){
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['homepage_no'] ?></td>
                                                        <td><?php echo $row['file_name'] ?></td>
                                                        <td><?php echo $row['manager_name'] ?></td>
                                                        <td><?php echo $row['status'] ?></td>
                                                        <td><?php echo $row['time'] ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                        catch(PDOException $ex){
                                            ?>
                                                <tr>
                                                    <td colspan="5">Data read error ... ...</td>    
                                                </tr>
                                            <?php
                                        }
                                        
                                    }
                                    catch(PDOException $ex){
                                        ?>
                                            <tr>
                                                <td colspan="5">Data read error ... ...</td>    
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    <?php  
                    }
                    else{
                        ?>
                            <script>
                                window.location.assign('pending.php');
                            </script>
                        <?php
                    }
            ?>
            </body>
            </html>
            <?php
            }
            else{
        ?>
        <script>window.location.assign('../login.php');</script>
        <?php
    }
        }
    else{
        ?>
        <script>window.location.assign('../login.php');</script>
        <?php
    }
    ?>