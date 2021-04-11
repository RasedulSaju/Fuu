<?php
session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username']) && !empty($_SESSION['role'])){
        if($_SESSION['role']=='manager'){
			$name=$_SESSION['username'];
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Pending Orders List | Manager | Fuu</title>
                <link href="../logo.jpg" rel="icon"/>
            </head>
            <body>
                <?php
                    include '../config.php';
                ?>
                <h3>Fuu Pending Orders List</h3>
                <br>
                <a href="index.php">Go Back</a> | <a href="order.php">Add order</a> | <a href="../logout.php">Log Out</a>
                <br>
                <br>
                <input type="search" id="searchbox">
                <input type="button" value="Search" id="searchbtn">
                <br>
                <script>
                    var srcbtn=document.getElementById('searchbtn');
                    srcbtn.addEventListener('click', searchprocess);

                    function searchprocess(){
                        var searchvalue=document.getElementById('searchbox').value;
                        window.location.assign("searchpage.php?param1="+searchvalue);
                    }

                </script>
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

                            $sqlquery="SELECT * FROM home WHERE manager_name='$name' AND status='pending'";

                            try{
                                $returnval=$dbcon->query($sqlquery); ///PDO Statement

                                $hometable=$returnval->fetchAll();

                                foreach($hometable as $row){

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