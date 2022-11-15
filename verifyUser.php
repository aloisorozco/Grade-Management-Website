<?php 

error_reporting(E_ERROR | E_PARSE);

if(!isset($_COOKIE["id"])) {
    header("Location: studentLogin.php");
    exit();
}
else {
    $url = $_SERVER['REQUEST_URI'];

    if ($_COOKIE["isStudent"]) {
        if (!str_contains($url, "student")) { 
            header("Location: studentMainPage.php");
            exit();
        }
    }
    else {
        if (!str_contains($url, "teacher")) { 
            header("Location: teacherMainPage.php");
            exit();
        }
    }
    //echo $_COOKIE["id"];
}

?>