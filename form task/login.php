<?php
session_start();
$message="";
if (isset($_POST["submit"])) {
    $username=$_POST["username"];
    $password=$_POST["password"];
    $password=md5($password);
    $sql="SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password'";
    include "config.php";
    $data=$conn->query($sql);
    if ($data->num_rows>0) {
        while ($row=$data->fetch_assoc()) {
            if ($row["role"]=="user") {
                $_SESSION['username']=$username;
                header('Location:take_test.php');

            } elseif ($row["role"]=="admin") {
                $_SESSION["admin"]=$username;
                header('Location:add_questions.php');
            }  
        }
        
    } else {
        $message="Please enter correct username and password";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        <div class="form-decorate">
            <form action="login.php" method="post">
                <p>
                    <label for="username">Username<label>
                    <input type="text" class="medium-input" name="username" required>
                </p>
                <p>
                    <label for="password">Password<label>
                    <input type="password" class="medium-input" name="password" required> 
                </p>
                <p>
                    <input type="submit" value="sign in" class="submit" name="submit" required>
                </p>
            </form>
            <form action="signup.php">
                <p>Don't have an account?</p>
                <input type="submit" value="sign up" class="submit">
            </form>
        </div>
        <div class="error">
            <?php
            echo $message;
            ?>
        </div>
    </body>
</html>