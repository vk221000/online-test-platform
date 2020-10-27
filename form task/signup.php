<?php
$success="";
$error="";
if (isset($_POST["submit"])) {
    $username=$_POST['username'];
    $email=$_POST["email"];
    $password1=$_POST["password1"];
    $password2=$_POST["password2"];
    if (!duplicateEmail($email)) {
        if (!duplicateUsername($username)) {
            if ($password1==$password2) {
                include "config.php";
                $password=md5($password1);
                $sql="INSERT INTO `users`(`username`, `email`, `password`, `role`) VALUES ('$username', '$email', '$password', 'user')";
                if ($conn->query($sql)===true) {
                    $success="ID successfully Created";
                }
            }
        } else {
            $error="Duplicate Username";
        }
        

    } else {
        $error="Duplicate Email";
    }
    
}
function duplicateEmail($email){
    include "config.php";
    $sql="SELECT * FROM `users` WHERE `email`='$email'";
    $data=$conn->query($sql);
    if ($data->num_rows>0) {
        return true;
    }
    return false;
}
function duplicateUsername($username){
    include "config.php";
    $sql="SELECT * FROM `users` WHERE `username`='$username'";
    $data=$conn->query($sql);
    if ($data->num_rows>0) {
        return true;
    }
    return false;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
        <link type="text/css" rel="stylesheet" href="style.css?=1">
    </head>
    <body>
        <div class="form-decorate">
            <form action="signup.php" method="POST">
                <p>
                    <label for="username">Username</label>
                    <input type="text" name="username" class="medium-input" required>
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="text" name="email" class="medium-input" required>
                </p>
                <p>
                    <label for="password1">Password</label>
                    <input type="password" name="password1" class="medium-input" required>
                </p>
                <p>
                    <label for="password2">Re Password</label>
                    <input type="password" name="password2" class="medium-input" required>
                </p>
                <p><input type="submit" value="sign up" name="submit" class="submit"></p>
            </form>
            <form action="login.php" method="post">
                <p>Already have an account ?</p>
                <input type="submit" value="sign in"  class="submit">
            <form>
        </div>
        <div class="success">
            <?php
            echo $success;
            ?>
        </div>
        <div class="error">
            <?php
            echo $error;
            ?>
        </div>
    </body>
</html>