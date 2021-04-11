<?php
session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username']) && !empty($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>User List | Admin | Fuu</title>
                <link href="../logo.jpg" rel="icon"/>
            </head>
            <body>
                <?php
                    include '../config.php';
                ?>
                <h3>Fuu User List</h3>
                <br>
                <a href="index.php">Go Back</a> | <a href="adduser.php">Add User</a> | <a href="../logout.php">Log Out</a>
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        try{
                            $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
                            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sqlquery="SELECT * FROM login";

                            try{
                                $returnval=$dbcon->query($sqlquery); ///PDO Statement

                                $logintable=$returnval->fetchAll();

                                foreach($logintable as $row){

                    ?>

                                <tr>
                                    <td><?php echo $row['login_no'] ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['phone'] ?></td>
                                    <td><?php echo $row['position'] ?></td>
                                    <td><a href="edituser.php?id=<?php echo $row['login_no'] ?>">Edit</a> | <a href="deleteuser.php?id=<?php echo $row['login_no'] ?>">Delete</a></td>
                                </tr>

                                <?php
                                                               }
                            }
                            catch(PDOException $ex){
                                ?>

                                <tr>
                                    <td colspan="6">Data read error ... ...</td>
                                </tr>
                                <?php
                            }               
                        }

                        catch(PDOException $ex){

                        ?>
                                <tr>
                                    <td colspan="6">Data read error ... ...</td>
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