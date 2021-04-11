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
                <a href="users.php">Go Back</a> | <a href="../logout.php">Log Out</a>
                <br>
                <h3>Edit Existing Fuu User</h3>
                <?php
                include'../config.php';
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    try{
                        $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
                        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sqlquery="SELECT * FROM login WHERE login_no=$id";

                        try{
                            $returnval=$dbcon->query($sqlquery); ///PDO Statement

                            $userdata=$returnval->fetchAll();

                            foreach($userdata as $info){

            ?>

                    <form action="updateuser.php?id=<?php echo $id; ?>" method="POST">
                        User Name: <input type="text" name="uname" value="<?php echo $info['name']; ?>"><br><br>
                        Email: <input type="email" name="uemail" value="<?php echo $info['email']; ?>"><br><br>
                        Phone: <input type="text" name="uphone" value="<?php echo $info['phone']; ?>"><br><br>
                        Password: <input type="password" name="upass"><br><br>

                        Position: <input type="radio" id="admin" name="upos" value="admin" <?php if($info['position']=='admin'){?>checked<?php }?>>
                            <label for="admin">Admin</label>
                            <input type="radio" id="manager" name="upos" value="manager" <?php if($info['position']=='manager'){?>checked<?php }?>>
                            <label for="manager">Manager</label>
                            <input type="radio" id="chef" name="upos" value="chef" <?php if($info['position']=='chef'){?>checked<?php }?>>
                        <label for="chef">Chef</label>
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