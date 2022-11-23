<?php 
include "connectToDB.php";

$sql = "DELETE FROM grade WHERE assignmentName = ? AND teacherId = ?;";
$stmt= $pdo->prepare($sql);
$stmt->execute([$_COOKIE["assignment"],$_COOKIE["id"]]);

while(!$stmt);

$sql = "DELETE FROM questions WHERE assignmentName = ? AND teacherId = ?;";
$stmt= $pdo->prepare($sql);
$stmt->execute([$_COOKIE["assignment"], $_COOKIE["id"]]);

while(!$stmt);

$sql = "DELETE FROM assignment WHERE name = ? AND teacherId = ?;";
$stmt= $pdo->prepare($sql);
$stmt->execute([$_COOKIE["assignment"], $_COOKIE['id']]);
header("Location: teacherMainPage.php");
?>


