
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location:login.php');
}
include "config.php";
$sql="SELECT * FROM `options`";
$data=$conn->query($sql);
$table="<div><form method='post' action='take_test.php'>";
$count=1;
if ($data->num_rows>0) {
    $answers=array();
    while ($row=$data->fetch_assoc()) {
        $table.="<p>".$count.". ".$row['question'].".<p>
                <p>
                    <input type='radio' name='test".$count."' value=".$row['option1'].">
                    <label>".$row['option1']."</label>
                </p>
                <p>
                    <input type='radio' name='test".$count."' value=".$row['option2'].">
                    <label>".$row['option2']."</label>
                </p>
                <p>
                    <input type='radio' name='test".$count."' value=".$row['option3'].">
                    <label>".$row['option3']."</label>
                </p>
                <p>
                    <input type='radio' name='test".$count."' value=".$row['option4'].">
                    <label>".$row['option4']."</label>
                </p>";
        $count+=1;
        $option=$row['correct_answer'];
        array_push($answers, $row[$option]);
    }
    $table.="<input type='submit' value='Submit Test' name='submit' class='submit'></form></div>";
}
if (isset($_POST['submit'])) {
    $table="<div id='bold'>Hello  ".$_SESSION['username'].", Your Response is: </div>";
    $temp=1;
    $correct=0;
    $wrong=0;
    foreach ($answers as $key=>$val) {
        if (isset($_POST['test'.$temp.''])) {
            if ($val==$_POST['test'.$temp.'']) {
                $correct+=1;
            }
            else {
                $wrong+=1;
            }
        } else {
            $wrong+=1;
        }
        $temp+=1; 
    }
    $table.="Correct:".$correct."<br>Incorrect:".$wrong."";
    $username=$_SESSION['username'];
    $sql="INSERT INTO `marks`(`username`, `marks`) VALUES ('$username', '$correct')";
    $conn->query($sql);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Take Test</title>
        <link rel= "stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="nav-button">
            <ul>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
        <div id="content">
            <?php
            echo $table;
            ?>
        </div>
        
    </body>
</html>