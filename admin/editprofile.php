<?php
session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username']) && !empty($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            $var1=$_SESSION['username'];
            ?>
            <!DOCTYPE html>
            <html>

            <head>
                <meta charset="utf-8">
                <title>Edit User | Admin | Fuu</title>
                <link href="../logo.jpg" rel="icon"/>
            </head>

            <body>
                <a href="index.php">Go Home</a> | <a href="../logout.php">Log Out</a>
                <br>
                <h3>Edit Profile</h3>
                <?php
                include'../config.php';
                    try{
                        $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
                        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                        $sqlquery="SELECT * FROM login WHERE name='$var1'";
                        try{
                            $returnval=$dbcon->query($sqlquery); ///PDO Statement
                            
                            $userdata=$returnval->fetchAll();
                    
                            foreach($userdata as $info){

            ?>

                    <form action="updateprofile.php" method="POST">
                        User Name: <input type="text" value="<?php echo $info['name']; ?>" disabled><br><br>
                        Email: <input type="email" name="uemail" value="<?php echo $info['email']; ?>"><br><br>
                        Phone: <input type="text" name="uphone" value="<?php echo $info['phone']; ?>"><br><br>
                        Password: <input type="password" name="upass"><br><br>
                        
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