<?php 

error_reporting(E_ERROR | E_PARSE);

include "connectToDB.php";

$error = "";



class Student {};

$q1 = "SELECT firstName, lastName FROM students WHERE id='{$_COOKIE['id']}' LIMIT 1";

$student = $pdo->query($q1)->fetchObject('Student');

if (isset($_POST['email'])) {

    
    $q2 = "UPDATE students SET firstName = ?, lastName = ?, email = ?, password = ? WHERE id = ? AND email = ? AND password = ?";

    //try {
        $pdo->prepare($q2)->execute([$_POST['first-name'], $_POST['last-name'], $_POST['email'],$_POST['password'],$_COOKIE['id'], $_POST['old-email'], $_POST['old-password']]);

        header("Location: studentMainPage.php");
        //should have a pop up msg in studentMainPage but whatever
        exit();
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
                    <form action="studentUpdateAccount.php" id="studentRegisterForm" method="post">
                        <div class="mb-8" id="title-div">
                            <p class="h2" id="register-title">Update your account</p>
                        </div>
                        <div class="mb-3 text-div">
                            <div class="mb-2 ind-div">
                                <label for="first-name" class="form-label" id="validFirstNameMsg">First Name</label>
                                <?php 
                                    echo '<input type="text" class="form-control" id="first-name" name="first-name"' . 'value="'. $student->firstName .'">';
                                ?>
                            </div>
                            <div class="mb-2 ind-div">
                                <label for="last-name" class="form-label" id="validLastNameMsg">Last Name</label>
                                <?php 
                                    echo '<input type="text" class="form-control" id="last-name" name="last-name"' . 'value="'. $student->lastName .'">';
                                ?>
                            </div>
                          </div>
                        <div class="mb-3 text-div">
                            <div class="mb-2 ind-div">
                                <label for="old-email" class="form-label" id="validConfirmEmailMsg">Old Email</label>
                                <input type="text" class="form-control" id="old-email" name="old-email">
                                
                            </div>
                            <div class="mb-2 ind-div">
                                <label for="email" class="form-label" id="validEmailMsg">New Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="mb-3 text-div">
                        </div>
                        <div class="mb-1 password-div">
                            <div class="mb-2 ind-div">
                                <label for="old-password" class="form-label" id="validPasswordMsg">Old Password</label>
                                <input type="password" class="form-control" id="old-password" name="old-password">
                            </div>
                            <div class="mb-2 ind-div">
                                <label for="pasword" class="form-label" id="validConfirmMsg">New Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="mt-1">
                            <p id="passwordStructMsg">Password must be 8-20 chars long<br>& have at least 1 number</p>
                            <p id="emailExistsMsg" style="color: red;"><?php echo $error; ?></p>
                            <!-- should check input with js but whatever -->
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-3 col-sm-2"></div>
            </div>
        </div>
        <script src="registerScript.js"></script>
    </body>
    
</html>