<?php
session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['role']) && !empty($_SESSION['username']) && !empty($_SESSION['role'])){
        if($_SESSION['role']=='admin'){
            ?>
            <!DOCTYPE html>
            <html>

            <head>
                <meta charset="utf-8">
                <title>Add New Order | Admin | Fuu</title>
                <link href="../logo.jpg" rel="icon"/>
            </head>

            <body>
                <a href="index.php">Go Back</a> | <a href="../logout.php">Log Out</a>
                <br>
                <h3>Add a Fuu Order</h3>
                <form action="createmarket.php" method="POST">
                    Materials <q>(Select Multiple by presing <cite>ctrl</cite>)</q>:<br>
                    <select name="menu[]" multiple="multiple">
                        <option value="Tomato">Tomato</option>
                        <option value="Cheese">Cheese</option>
                        <option value="Baan">Baan</option>
                        <option value="Duck Meat">Duck Meat</option>
                        <option value="Rice">Rice</option>
                        <option value="Tea">Tea</option>
                        <option value="Milk">Milk</option>
                        <option value="Potato">Potato</option>
                        <option value="Lemon">Lemon</option>
                        <option value="Plastic Cup">Plastic Cup</option>
                    </select><br><br>
                    Cost: <input type="number" name="cost"><br><br>
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