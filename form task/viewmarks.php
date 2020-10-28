<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location:login.php');
}
include "config.php";
$sql="SELECT * FROM `marks`";
$data=$conn->query($sql);
$html="<div><table><tr><th>UserName</th><th>Marks</th></tr>";
if ($data->num_rows>0) {
    while ($row=$data->fetch_assoc()) {
        $html.="<tr><td>".$row['username']."</td><td>".$row['marks']."</td></tr>";
    }
}
$html.="</table></div>";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ViewMarks</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="nav-button">
            <ul>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
        <div class='table-decorate'>
            <?php
            echo $html;
            ?>
        </div>
    </body>
</html>
