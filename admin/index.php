<?php
session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username']) && !empty($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            $var1=$_SESSION['username'];
                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>Admin Dashboard | Fuu</title>
                    <link href="../logo.jpg" rel="icon"/>
                </head>
                <body>
                    <h2>Welcome <?php echo $var1; ?></h2>
                    <br>
                    <h3>Fuu Admin Dashboard</h3>
                    <br>
                    <a href="users.php">Manage Users</a> | <a href="editprofile.php">Edit Profile</a> | <a href="orders.php">Orders</a> | <a href="rawmaterials.php">Raw Materials</a> | <a href="../logout.php">Log Out</a><br>
                    <img src="../logo.jpg" alt="Fuu" height="216px" width="384px">
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