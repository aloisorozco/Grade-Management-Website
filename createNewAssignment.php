<?php 
$name = $_POST["assignmentName"];
$weight = $_POST["assignmentWeight"];
$nbQuestions = $_POST["assignmentNumberQuestions"];
$dueDate = $_POST["assignmentDueDate"];
$description = $_POST["assignmentDescription"];


$error = "";

class Assignment {};

if (isset($_POST['assignmentName']) and (strcmp($name,"") != 0)) {

    include "connectToDB.php";

    $q = "SELECT weight FROM assignment WHERE teacherId='{$_COOKIE['id']}'";
            
    $assignments = $pdo->query($q)->fetchAll(PDO::FETCH_CLASS, 'Assignment');

    $totalWeight = 0;
    foreach ($assignments as $assignment) {
        $totalWeight += $assignment->weight;
    }
    $totalWeight += $_POST["assignmentWeight"];
    echo $totalWeight;

    if ($totalWeight > 100) {
        $error = "Total weight of assignments must be under 100";
        setcookie("assignmentWeightError", $error, time() + (86400 * 30), "/");
        echo  $error ;
    }
    else {
        
        
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
    }

    
    header("Location: teacherMainPage.php");
}
?>