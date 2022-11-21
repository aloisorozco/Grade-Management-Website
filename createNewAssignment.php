<?php 
$name = $_POST["assignmentName"];
$weight = $_POST["assignmentWeight"];
$nbQuestions = $_POST["assignmentNumberQuestions"];
$dueDate = $_POST["assignmentDueDate"];
$description = $_POST["assignmentDescription"];

include "connectToDB.php";

$sql = "INSERT INTO assignment(description,dueDate,name,number_of_questions,teacherId,weight) VALUES (?,?,?,?,?,?)";
$stmt= $pdo->prepare($sql);
$stmt->execute([$description, $dueDate,$name,$nbQuestions,$_COOKIE["id"],$weight]);

//$sql = "INSERT INTO questions VALUES (name,weight)";
//For each questions

foreach ($_POST as $key => $value) {
    if($key[0] == 'q'){
        $sql = "INSERT INTO questions(assignmentName,weight) VALUES (?,?)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$name, $value]);
        echo "$key = $value<br>";
    }
}
header("Location: teacherMainPage.php");

?>