<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location:login.php');
}
$message="";
if (isset($_POST['submit'])) {
    $question=$_POST["question"];
    $option1=$_POST["option1"];
    $option2=$_POST["option2"];
    $option3=$_POST["option3"];
    $option4=$_POST["option4"];
    $correct_answer=$_POST["dropdown"];
    include "config.php";
    $sql= " INSERT INTO `options`(question, option1, option2, option3, option4, correct_answer) VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$correct_answer') ";
    if ($conn->query($sql)===true) {
        $message="question successfully added";
    } else {
        $message=$conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Questions</title>
        <link rel="stylesheet" type="text/css" href="style.css?=1">
    </head>
    <body>
        <div class="nav-button">
            <ul>
                <li><a href="manageusers.php">ManageUsers</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
        <div class="form-decorate">
            <form  action="add_questions.php" method="POST">
                <p>
                    <label>Question</label>
                    <input type="text" name="question" class="large-input" required>
                </p>
                <p>
                    <label>Option 1</label>
                    <input type="text" name="option1" class="medium-input" required>
                </p>
                <p>
                    <label>Option 2</label>
                    <input type="text" name="option2" class="medium-input" required>
                </p>
                <p>
                    <label>Option 3</label>
                    <input type="text" name="option3" class="medium-input" required>
                </p>
                <p>
                    <label>Option 4</label>
                    <input type="text" name="option4" class="medium-input" required>
                </p>
                <p>
				<label>Correct option</label>
				<select name="dropdown">
			    <option value="option1">option1</option>
				<option value="option2">option2</option>
				<option value="option3">option3</option>
				<option value="option4">option4</option>
				</select>
				</p>
                <p>
                    <input type="submit" value="submit" name="submit" class="submit">
                </p>
            </form>
        </div>
        <div class="success">
            <?php
            echo $message;
            ?>
        </div>
    </body>
</html>
