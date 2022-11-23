<?php

function addGrade(){
    include "connectToDB.php";
// Get all students with a grade for this assignment
    $sql = "SELECT studentId, score FROM grade WHERE assignmentName = ? AND teacherId = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$_COOKIE["assignment"], $_COOKIE['id']]);
    $set = $stmt->fetchAll();

    //Get the name of each of those students and echo it

    foreach($set as $row){
        $sql1 = "SELECT firstName, lastName FROM students WHERE id=?";
        $stmt = $pdo->prepare($sql1);
        $stmt->execute([$row['studentId']]);
        $name = $stmt->fetch();
        echo "<p>" . $name['firstName'] . " " . $name['lastName'] . ": " . $row['score']. "%</p>";
    }

}

?>