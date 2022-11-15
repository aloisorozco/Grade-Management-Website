<?php 

error_reporting(E_ERROR | E_PARSE);

include "connectToDB.php";

$error = "";

class Teacher {};

if (isset($_POST['email'])) {

$q = "SELECT id, email, password FROM teachers WHERE email='{$_POST['email']}' AND password='{$_POST['password']}' LIMIT 1";
    
$teacher = $pdo->query($q)->fetchObject('Teacher');

if ($teacher->email == null) {
    $error = "Invalid credentials";
    
}
else {
    setcookie("id", $teacher->id, time() + (86400 * 30), "/");
    setcookie("isStudent", false, time() + (86400 * 30), "/");
    header("Location: teacherMainPage.php");
    exit();
}
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="loginStyle.css" rel="stylesheet">
    
</head>
<body>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-7 col-sm-2" id="blank-div">
                                
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-8" id="login-main-div">
                <div id="title-div"><h1 id="title-header">Grade Management System</h1></div>
                <div class="login-header-div">
                    <h3 id="login-header">Teacher Login</h3>
                </div>
                <div id="login-div">
                    <form action="teacherLogin.php" id="teacherLoginForm" method="post">
                        <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <p id="validEmailPasswordMsg">
                            <?php echo $error ?>
                        </p>
                        <button type="button" class="btn btn-primary mb-3" onclick="loginButtonClicked()">Login</button>
                      </form>
                </div>
                <div id="link-div">
                    <a href="teacherRegister.php">Register</a>
                    <a href="studentLogin.php">Not a teacher? Click here to access student login</a>
                </div>
            </div>
            <div class="col-md-0 col-sm-2"></div>
        </div>
    </div>
    <script src="loginScript.js"></script>
</body>
</html>