<?php
session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username']) && !empty($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            ?>
            <!DOCTYPE html>
            <html>

            <head>
                <meta charset="utf-8">
                <title>Add New User | Admin | Fuu</title>
                <link href="../logo.jpg" rel="icon"/>
            </head>

            <body>
                <a href="users.php">Go Back</a> | <a href="../logout.php">Log Out</a>
                <br>
                <h3>Add a Fuu User</h3>
                <form action="registeruser.php" method="POST">
                    User Name: <input type="text" name="uname"><br><br>
                    Email: <input type="email" name="uemail"><br><br>
                    Phone: <input type="text" name="uphone"><br><br>
                    Password: <input type="password" name="upass"><br><br>

                    Position: <input type="radio" id="admin" name="upos" value="admin">
                    <label for="admin">Admin</label>
                    <input type="radio" id="manager" name="upos" value="manager">
                    <label for="manager">Manager</label>
                    <input type="radio" id="chef" name="upos" value="chef">
                    <label for="chef">Chef</label>
                    <br><br>
                    <input type="submit" value="Register">
                </form>
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