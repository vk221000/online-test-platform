<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location:login.php');
}
include "config.php";
$sql="SELECT * FROM `users`";
$data=$conn->query($sql);
$table="<table><tr><th>Username</th><th>Email</th><th>Action</th></tr>";
if ($data->num_rows>0) {
    while ($row=$data->fetch_assoc()) {
        $table.="<tr><td>".$row['username']."</td><td>".$row['email']."</td><td><a href='edituser.php?editid=".$row['userid']."'>Edit</a> | <a href='edituser.php?deleteid=".$row['userid']."'>Delete</a></td></tr>";
    }
    
}
$table.="</table>";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ManageUsers</title>
    </head>
    <body>
        <div class="nav-button">
            <ul>
                <li><a href="logout.php">Log Out</a></li>
                <link rel="stylesheet" type="text/css" href="style.css?=1">
            </ul>
        </div>
        <div class='table-decorate'>
            <?php
            echo $table;
            ?>
        </div>
    </body>
</html>