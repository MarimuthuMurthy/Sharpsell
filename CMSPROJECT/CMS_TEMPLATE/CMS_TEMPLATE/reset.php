<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
    if(!isset($_GET['email']) && !$_GET['token'])
    {
        header("Location: index.php");
    }

    // $email = 'murthy@gmail.com';
    // $token = '901e7726c24bc094cef9e7adddcd419f8828d33a5ca1c9206bcf05b5296142c68d30d404a8d4694a02dc81c474ecbc05a6c2';
    if($stmt = mysqli_prepare($connection , 'select user_name , user_email , token from users where token=?'))
    {
        mysqli_stmt_bind_param($stmt , "s",$_GET['token']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt , $user_name , $user_email , $token);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        // if($_GET['token'] !== $token || $_GET['email']!== $user_email)
        // {
        //     header("Location: index.php");
        // }
        if(isset($_POST['password']) && isset($_POST['confirm_password']))
        {
            if($_POST['password'] === $_POST['confirm_password'])
            {
                $password = $_POST['password'];
                $hashed_passowrd = password_hash($password , PASSWORD_BCRYPT , array('cost'=>12));
                if($stmt = mysqli_prepare($connection , "update users set token = '' , user_password = '{$hashed_passowrd}' where user_email = ?"))
                {
                    mysqli_stmt_bind_param($stmt , "s",$_GET['email']);
                    mysqli_stmt_execute($stmt);
                    if(mysqli_stmt_affected_rows($stmt)>=1)
                    {
                        header("Location:login.php");
                    }
                    mysqli_stmt_close($stmt);
                }
            }
        }
    }
?>

<?php include "includes/navigation.php"?>

<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="password" name="password" placeholder="enter password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="confirm_password" name="confirm_password" placeholder="re enter password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    



    <hr>

    <?php include "includes/footer.php";?>

</div> 