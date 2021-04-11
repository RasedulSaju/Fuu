<?php
session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username']) && !empty($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Search User | Admin | Fuu</title>
                <link href="../logo.jpg" rel="icon"/>
            </head>
            <body>
                <h3>Search Fuu User Including <q><b><?php echo $_GET['param1'] ?></b></q></h3>
                <a href="users.php">Go Back</a> | <a href="../logout.php">Log Out</a>
                <?php
                    include'../config.php';
                    if(isset($_GET['param1']) && !empty($_GET['param1'])){
                    ?> 
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Action</th>
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
                                            $sqlquery="SELECT * FROM login where name LIKE '%$searchval%'";
                                        }


                                        try{
                                            $returnval=$dbcon->query($sqlquery); ///PDO Statement

                                            $productstable=$returnval->fetchAll();

                                            foreach($productstable as $row){
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['login_no'] ?></td>
                                                        <td><?php echo $row['name'] ?></td>
                                                        <td><?php echo $row['position'] ?></td>
                                                        <td><a href="edituser.php?id=<?php echo $row['login_no'] ?>">Edit</a> | <a href="deleteuser.php?id=<?php echo $row['login_no'] ?>">Delete</a></td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                        catch(PDOException $ex){
                                            ?>
                                                <tr>
                                                    <td colspan="4">Data read error ... ...</td>    
                                                </tr>
                                            <?php
                                        }

                                    }
                                    catch(PDOException $ex){
                                        ?>
                                            <tr>
                                                <td colspan="4">Data read error ... ...</td>    
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
                                window.location.assign('users.php');
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