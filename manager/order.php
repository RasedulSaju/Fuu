<?php
session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username']) && !empty($_SESSION['role'])){
        if($_SESSION['role']=='manager'){
            ?>
            <!DOCTYPE html>
            <html>

            <head>
                <meta charset="utf-8">
                <title>Add New Order | Manager | Fuu</title>
                <link href="../logo.jpg" rel="icon"/>
            </head>

            <body>
                <a href="index.php">Go Back</a> | <a href="../logout.php">Log Out</a>
                <br>
                <h3>Add a Fuu Order</h3>
                <form action="createorder.php" method="POST">
                    Order Details <q>(Select Multiple by presing <cite>ctrl</cite>)</q>:<br>
                    <select name="orderlist[]" multiple="multiple">
                        <option value="Burger">Burger</option>
                        <option value="Fried Rice">Fried Rice</option>
                        <option value="French Fries">French Fries</option>
                        <option value="Duck Platter">Duck Platter</option>
                        <option value="Boiled Rice">Boiled Rice</option>
                        <option value="Tea">Tea</option>
                    </select><br><br>
                    Oder Created By: <input type="text" value="<?php echo $_SESSION['username'] ?>" disabled="disabled"><br><br>
                    <br><br>
                    <input type="submit" value="Submit Order">
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