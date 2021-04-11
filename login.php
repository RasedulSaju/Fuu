<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username'] && !empty($_SESSION['role']))){
    if($_SESSION['role']=='admin'){
        ?>
        <script>window.location.assign('admin/');</script>
        <?php
    }
    else if($_SESSION['role']=='manager'){
        ?>
        <script>window.location.assign('manager/');</script>
        <?php
    }
    else if($_SESSION['role']=='chef'){
    ?>
    <script>window.location.assign('chef/');</script>
    <?php
    }
}
else{
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login | Fuu</title>
    <link href="logo.jpg" rel="icon"/>
</head>

<body>
    <h3>Login</h3>
    <form action="verifyuser.php" method="POST">
        Username: <input type="text" name="uname"><br><br>
        Password: <input type="password" name="upass"><br><br>
        <br><br>
        <input type="submit" value="Sign In">
    </form>
</body>

</html>
<?php
}
?>