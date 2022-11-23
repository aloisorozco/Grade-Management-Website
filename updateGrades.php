<?php 
include "connectToDB.php";


foreach ($_POST as $key => $value) {
    $studentId = substr($key,6);
    echo $studentId;

    $sql = "SELECT * FROM grade WHERE assignmentName = ? AND studentId = ?;";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$_COOKIE['assignment'], $studentId]);
    $data = $stmt->fetchAll();

    if(count($data) === 0){
        $sql = "INSERT INTO grade (assignmentName, score,studentId,teacherId) VALUES (?,?,?,?);";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$_COOKIE['assignment'], $value, (int)$studentId, $_COOKIE['id']]);
    }

    else{
        $sql = "UPDATE grade SET score = ? WHERE assignmentName = ? AND studentId = ? AND teacherId = ?;";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$value, $_COOKIE['assignment'], (int)$studentId, $_COOKIE['id']]);
    }


}
    header("Location: teacherMainPage.php");
?>