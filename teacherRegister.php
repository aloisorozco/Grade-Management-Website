<?php 

//error_reporting(E_ERROR | E_PARSE);

include "connectToDB.php";

$error = "";

class Teacher {};

if (isset($_POST['email'])) {

    $q1 = "SELECT email FROM teachers WHERE email='{$_POST['email']}' AND password='{$_POST['password']}' LIMIT 1";
    $q2 = "INSERT INTO teachers (email, password, firstName, lastName, className) VALUES (?,?,?,?,?)";
    

    $teacher = $pdo->query($q1)->fetchObject('Teacher');

    if (!is_null($teacher) and $teacher->email == $_POST['email']) {
        $error = "Email already exists";
        
    }
    //else if {
    //}
    else {

        //try {
            $pdo->prepare($q2)->execute([$_POST['email'], $_POST['password'], $_POST['first-name'],$_POST['last-name'], $_POST['class']]);

            header("Location: teacherLogin.php");
            exit();

        //} catch (Exception $ex) {
        //    echo $ex->getMessage();
        //}
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
        <link href="registerStyle.css" rel="stylesheet">
        
    </head>
    <body>
        <nav></nav>
        <div class="container-fluid text-center" id="container-div">
            <div class="row">
                <div class="col-xl-4 col-lg-3 col-sm-2"></div>
                <div class="col-xl-4 col-lg-6 col-sm-8" id="register-form-div">
                    <form action="teacherRegister.php" id="teacherRegisterForm" method="post">
                        <div class="mb-8" id="title-div">
                            <p class="h2" id="register-title">Create your account</p>
                        </div>
                        <div class="mb-3 text-div">
                            <div class="mb-2 ind-div">
                                <label for="first-name" class="form-label" id="validFirstNameMsg">First Name</label>
                                <input type="text" class="form-control" id="first-name" name="first-name">
                                
                            </div>
                            <div class="mb-2 ind-div">
                                <label for="last-name" class="form-label" id="validLastNameMsg">Last Name</label>
                                <input type="text" class="form-control" id="last-name" name="last-name">
                            </div>
                          </div>
                        <div class="mb-3 text-div">
                            <div class="mb-2 ind-div">
                                <label for="class" class="form-label" id="validClassMsg">Class</label>
                                <input type="text" class="form-control" id="class" name="class">
                            </div>
                            <div class="mb-2 ind-div">
                                <label for="email" class="form-label" id="validEmailMsg">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                          </div>
                        <div class="mb-3 text-div">
                        </div>
                        <div class="mb-1 password-div">
                            <div class="mb-2 ind-div">
                                <label for="password" class="form-label" id="validPasswordMsg">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-2 ind-div">
                                <label for="confirmPassword" class="form-label" id="validConfirmMsg">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm-password">
                            </div>
                        </div>
                        <div class="mt-1">
                            <p id="passwordStructMsg">Password must be 8-20 chars long<br>& have at least 1 number</p>
                            <p id="emailExistsMsg" style="color: red;"><?php echo $error; ?></p>
                            <button type="button" class="btn btn-primary" onclick="registerButtonClicked()">Register</button>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-3 col-sm-2"></div>
            </div>
        </div>
        <script src="registerScript.js"></script>
    </body>
    
</html>