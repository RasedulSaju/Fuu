<?php
session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username']) && !empty($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            ?>
            <!DOCTYPE html>
            <html>

            <head>
                <meta charset="utf-8">
                <title>Edit User | Admin | Fuu</title>
                <link href="../logo.jpg" rel="icon"/>
            </head>

            <body>
                <a href="orders.php">Go Back</a> | <a href="../logout.php">Log Out</a>
                <br>
                <h3>Edit Existing Fuu Order</h3>
                <?php
                include'../config.php';
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    try{
                        $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
                        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sqlquery="SELECT * FROM home WHERE homepage_no=$id";

                        try{
                            $returnval=$dbcon->query($sqlquery); ///PDO Statement

                            $userdata=$returnval->fetchAll();

                            foreach($userdata as $info){

            ?>

                    <form action="updateorder.php?id=<?php echo $id; ?>" method="POST">
                        Order Details: <textarea name="orderlist" rows="4"><?php echo $info['file_name'] ?></textarea><br><br>
                        Oder Created By: <input name="manager" type="text" value="<?php echo $info['manager_name'] ?>"><br><br>
                        <br><br>
                        Status: <input type="radio" id="pending" name="stts" value="pending" <?php if($info['status']=='pending'){?>checked<?php }?>>
                            <label for="pending">Pending</label>
                            <input type="radio" id="complete" name="stts" value="complete" <?php if($info['status']=='complete'){?>checked<?php }?>>
                            <label for="complete">Complete</label>
                            <input type="radio" id="rejected" name="stts" value="rejected" <?php if($info['status']=='rejected'){?>checked<?php }?>>
                        <label for="rejected">Rejected</label>
                        <br><br>
                        <input type="submit" value="Update">
                    </form>

                    <?php
                                                   }
                }
                catch(PDOException $ex){
            ?>
                    <p>Data read error ... ...</p>
                    <?php
                }               
            }

            catch(PDOException $ex){

            ?>
                    <p>Data read error ... ...</p>
                    <?php
            }
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