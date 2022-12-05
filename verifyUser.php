<?php 

error_reporting(E_ERROR | E_PARSE);

//my php is running on an old version

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}


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