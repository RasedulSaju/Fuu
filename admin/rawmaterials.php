<?php
session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username']) && !empty($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Orders List | Admin | Fuu</title>
                <link href="../logo.jpg" rel="icon"/>
            </head>
            <body>
                <?php
                    include '../config.php';
                ?>
                <h3>Fuu Orders List</h3>
                <br>
                <a href="index.php">Go Back</a> | <a href="addmarket.php">Add Marketing Info</a> | <a href="../logout.php">Log Out</a>
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
                        window.location.assign("searchmaterial.php?param1="+searchvalue);
                    }
                </script>
                <table>
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Market List</th> 
                            <th>Cost</th> 
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        try{
                            $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
                            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sqlquery="SELECT * FROM raw_material";

                            try{
                                $returnval=$dbcon->query($sqlquery); ///PDO Statement

                                $hometable=$returnval->fetchAll();

                                foreach($hometable as $row){

                    ?>

                                <tr>
                                    <td><?php echo $row['raw_no'] ?></td>
                                    <td><?php echo $row['market_name'] ?></td>
                                    <td><?php echo $row['cost'] ?></td>
                                    <td><?php echo $row['market_time'] ?></td>
                                    <td><a href="editmarket.php?id=<?php echo $row['raw_no'] ?>">Edit</a> | <a href="deletemarket.php?id=<?php echo $row['raw_no'] ?>">Delete</a></td>
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