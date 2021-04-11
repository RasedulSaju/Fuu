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
                <a href="rawmaterials.php">Go Back</a> | <a href="../logout.php">Log Out</a>
                <br>
                <h3>Edit Existing Fuu Order</h3>
                <?php
                include'../config.php';
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    try{
                        $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
                        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sqlquery="SELECT * FROM raw_material WHERE raw_no=$id";

                        try{
                            $returnval=$dbcon->query($sqlquery); ///PDO Statement

                            $userdata=$returnval->fetchAll();

                            foreach($userdata as $info){

            ?>

                    <form action="updatemarket.php?id=<?php echo $id; ?>" method="POST">
                        Materials:
                        <textarea name="menu" rows="4"><?php echo $info['market_name'] ?></textarea><br><br>
                        Cost: <input type="number" name="cost" value="<?php echo $info['cost'] ?>"><br><br>
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