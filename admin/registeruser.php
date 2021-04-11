<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

    /// received data collection
    // $_POST represents an associative array
    include '../config.php';
    if(isset($_POST['uname']) && isset($_POST['uemail']) && isset($_POST['uphone']) && isset($_POST['upass']) && isset($_POST['upos']) && !empty($_POST['uname']) && !empty($_POST['uemail']) && !empty($_POST['uphone']) && !empty($_POST['upass']) && !empty($_POST['upos']) ){
        
        $var1=$_POST['uname'];
        $var2=$_POST['uemail'];
        $var3=$_POST['uphone'];
        $var4=md5($_POST['upass']);
        $var5=$_POST['upos'];
        $pass=$_POST['upass'];
        
        try{
            $dbcon = new PDO("mysql:host=$dbserver:$dbport;dbname=$db;","$dbuser","$dbpass");
            $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $query="INSERT INTO login (name, email, phone, password, position) VALUES('$var1','$var2','$var3','$var4','$var5')";
            
            try{
                /// to insert data to corresponding database
                $dbcon->exec($query);
                
                /// if successful, forward the user to the user list page
                
                //PHP Mail Starts -->
                
                
                //php mailer data starts

                require 'phpmailerlib/Exception.php';
                require 'phpmailerlib/PHPMailer.php';
                require 'phpmailerlib/SMTP.php';

                //Create a new PHPMailer instance
                $mail = new PHPMailer();

                //Tell PHPMailer to use SMTP
                $mail->isSMTP();

                // Enable SMTP debugging
                // SMTP::DEBUG_OFF = off (for production use)
                // SMTP::DEBUG_CLIENT = client messages
                // SMTP::DEBUG_SERVER = client and server messages
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;

                //Set the hostname of the mail server
                $mail->Host = 'smtp.gmail.com';
                // use
                // $mail->Host = gethostbyname('smtp.gmail.com');
                // if your network does not support SMTP over IPv6

                //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                $mail->Port = 587;

                //Set the encryption mechanism to use - STARTTLS or SMTPS
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                //Whether to use SMTP authentication
                $mail->SMTPAuth = true;

                //---------------------------------------------------------------------------------------------------------
                //Username to use for SMTP authentication - use full email address for gmail
                $mail->Username = 'rislam181007@bscse.uiu.ac.bd';

                //Password to use for SMTP authentication
                $mail->Password = 'EmailPassword';

                //Set who the message is to be sent from
                $mail->setFrom('rislam181007@bscse.uiu.ac.bd', 'Rasedul Islam'); //youremail@gmail.com', 'mail sender name'

                //Set who the message is to be sent to
                $mail->addAddress('$var2', '$var1'); //mailreceiver@gmail.com', 'mail receiver name'

                $mail->addCC("rasedulsaju@gmail.com");
                //----------------------------------------------------------------------------------------------------------

                //Set the subject line
                $mail->Subject = 'Fuu Account Login Information';

                $message = "
                <html>
                    <head>
                        <title>Fuu Account Information</title>
                    </head>
                    <body>
                        <p>This email contains HTML Tags!</p>
                        <table>
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                            </tr>
                            <tr>
                                <td>$var1</td>
                                <td>$pass</td>
                            </tr>
                        </table>
                    </body>
                </html>
                ";

                $mail->Body = $message;//"Your Fuu Username: '$var1' & Password: '$pass'";

                $mail->IsHTML(true);

                if (!$mail->send()) {
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message sent!';
                }
                //. php Mailer Function Ends
                ?>
                   <!-- /. PHP Mail Ends -->
                    <script>window.location.assign('users.php')</script>
                <?php
            }
            catch(PDOException $ex){
                /// if not successful, return back to add user page
                ?>
                    <script>window.location.assign('adduser.php')</script>
                <?php
            }
            
        }
        catch(PDOException $ex){
            ?>
                <script>window.location.assign('adduser.php')</script>
            <?php
        }
    }
    else{
        ?>
            <script>window.location.assign('adduser.php')</script>
    
        <?php
        
    }
?>