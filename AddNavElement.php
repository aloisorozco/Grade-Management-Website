<?php 
include "connectToDB.php";

$sql = "SELECT name FROM assignment WHERE teacherId = ?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$_COOKIE["id"]]);

$name = $stmt->fetchAll();


foreach ($name as $row) {
    echo "<button onclick=\"menuToggler(); displayAssignment('". $row['name'] ."')\" type = 'button'>" . $row['name'] . "</button>";
    
}
 /*
foreach($name[] as $x){
    echo $x;
}
*/

//$sql = "INSERT INTO questions VALUES (name,weight)";
//For each questions


//header("Location: teacherMainPage.php");

?>