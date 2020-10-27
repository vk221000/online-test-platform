<?php
session_start();
include "config.php";
$html="";
if (!isset($_SESSION['admin'])) {
    header('Location:login.php');
}
if (isset($_GET["deleteid"])) {
    $deleteid=$_GET["deleteid"];
    $sql="DELETE FROM `users` WHERE `userid`=$deleteid";
    $conn->query($sql);
    header('Location:manageusers.php');
}
if (isset($_POST["submit"])) {
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $role=$_POST["role"];
    $password=md5($password);
    $sql="UPDATE `users` SET `username`='$username', `email`='$email', `password`='$password', `role`='$role' WHERE `username`='$username'";
    if ($conn->query($sql)===true) {
        header('Location:manageusers.php');
    } else {
        echo $conn->error;
    }
    
}
if (isset($_GET["editid"])) {
    $editid=$_GET["editid"];
    $sql="SELECT * FROM `users` where `userid`=$editid";
    $data=$conn->query($sql);
    if ($data->num_rows>0) {
        while ($row=$data->fetch_assoc()) {
            $userid=$row['userid'];
            $username=$row['username'];
            $email=$row['email'];
            $password=$row['password'];
            $role=$row['role'];
        }
        $html.='<div class="form-decorate">
            <form action="edituser.php" method="POST">
                <p>
                    <label for="username">Username</label>
                    <input type="text" name="username" class="medium-input" value="'.$username.'" readonly>
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="text" name="email" class="medium-input" value="'.$email.'" required>
                </p>
                <p>
                    <label for="password1">Password</label>
                    <input type="password" name="password" class="medium-input" value="'.$password.'" required>
                </p>
                <p>
                    <label for="role">Role</label>
                    <input type="text" name="role" class="medium-input" value="'.$role.'" required>
                </p>
                <p><input type="submit" value="Update" name="submit" class="submit"></p>
            </form>
        </div>';
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>EditUser</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body></body>
    <div>
        <?php
        echo $html;
        ?>
    </div>
</html>