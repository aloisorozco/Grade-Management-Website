<?php 
include "connectToDB.php";

$sql = "SELECT name FROM assignment WHERE teacherId IN (SELECT teacherId FROM students WHERE id = ?)";
$stmt= $pdo->prepare($sql);
$stmt->execute([$_COOKIE["id"]]);//$teacherId

$name = $stmt->fetchAll();


foreach ($name as $row) {
    echo "<button onclick=\"menuToggler(); displayAssignment('". $row['name'] ."')\" type = 'button'>" . $row['name'] . "</button>";
    
}
?>