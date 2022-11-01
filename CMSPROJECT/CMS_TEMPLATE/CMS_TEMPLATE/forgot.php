<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include_once "admin/functions1.php" ?>
<?php require 'vendor/autoload.php'; ?>

<?php


require './Classes/config.php';

if (!isset($_GET['forgot'])) {
    header("Location: index.php");
}
if (ifItIsMethod('post')) {

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));
        if (email_exists($email)) {
            if ($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' where user_email = ?")) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);


                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = '14cdbe97bff13a';                     //SMTP username
                    $mail->Password   = '107640e51a9288';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('vtu15892@veltech.edu.in', 'Mailer');
                    $mail->addAddress($email);
                    $mail->Subject = 'This is test email';
                    $mail->isHTML(true);
                    $mail->Body = '<p>Please click to reset your password</p>
                    <a href="http://localhost/MyFirstPhp/CMSPROJECT/CMS_TEMPLATE/CMS_TEMPLATE/reset.php?email="'.$email.'&token='.$token.'">Click here</a>
                    ';

                    //Optional name

                    $mail->send();
                    $email_sent = true;
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo mysqli_error($connection);
            }
        }
    }
}
?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <?php if (!isset($email_sent)) : ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                            <?php else : ?>
                                <h2>please check your mail</h2>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php"; ?>

</div> <!-- /.container -->