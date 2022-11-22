<?php 
include "connectToDB.php";

$sql = "DELETE FROM questions WHERE assignmentName = ?;";
$stmt= $pdo->prepare($sql);
$stmt->execute([$_COOKIE["assignment"]]);

while(!$stmt);

$sql = "DELETE FROM assignment WHERE name = ?;";
$stmt= $pdo->prepare($sql);
$stmt->execute([$_COOKIE["assignment"]]);
header("Location: teacherMainPage.php");
?>


