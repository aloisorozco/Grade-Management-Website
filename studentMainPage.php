<?php

include "verifyUser.php";
include "connectToDB.php";
include "gradeFinder.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="studentMainPage.css">
    <link rel="stylesheet" href="profile_button.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="popup.css">
    <script src="studentManagementHome.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        document.cookie = "assignment= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"

        function displayAssignment(name) {
            document.cookie = "assignment=" + name;
            console.log(document.cookie);
            document.getElementById('assignmentName').textContent = String(name);
            updateDiv();
        }

        function updateDiv() {
            $("#leftTable").load(window.location.href + " #leftTable");
            $("#lightTable").load(window.location.href + " #lightTable");
        }
    </script>

</head>

<body id="body">
    <header>
        <nav id="mainNav">
            <div id="subSection">
                <img onclick="menuToggler()" id="books" src="menu.png" alt="Image of a menu icon">
                <img id="menuIcon" src="book-stack.png" alt="Image of a book stack">
                <p>Student Management System</p>
            </div>
            <div id="subSection">
                <p id="teacherName">Student Name</p>
                <div class="action">
                    <div class="profile" onclick="activateMenu();">
                        <img src="ProfilePictures/profile_default.jpg" alt="Profile Picture">
                    </div>
                    <div class="menu">
                        <h3>Menu</h3>
                        <ul>
                            <li><img src="ProfilePictures/profile.png" alt=""><a href="studentUpdateAccount.php">Profile</a>
                            </li>
                            <li><img src="ProfilePictures/help.png" alt=""><a href="#">Grades</a></li>
                            <li><img src="ProfilePictures/help.png" alt=""><a href="#">Settings</a></li>
                            <li><img src="ProfilePictures/logout.png" alt=""><a href="studentLogin.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div id="content">
        <!--
        <nav id="sideNav">
            <h3>Navigation</h3>
            <button>Assignment 1</button>
            <button>Assignment 2</button>
            <button>Midterm</button>
            <button>Assignment 3</button>
            <button onclick="changeAssigmentName()">Add assignment</button>
        </nav>
        -->


        <nav id="sideNav">
            <h3>Navigation</h3>

            <?php include "AddNavElementStudent.php" ?>

            <!--
            <form action="#" onclick="menuToggler()">
                <button>Assignment 1</button>
            </form>
            <form action="#" onclick="menuToggler()">
                <button>Assignment 2</button>
            </form>
            <form action="#" onclick="menuToggler()">
                <button>Assignment 3</button>
            </form>
            <form action="#" onclick="menuToggler()">
                <button>Midterm</button>
            </form>
            -->

            <form action="studentAssessmentPage.html" onclick="menuToggler()">
                <button>Dark Mode</button>
            </form>

        </nav>

        <!---------------------------------------------------------- Default ---------------------------------------------------------->
        <div id="middleSection">
            <h3 id="assignmentName">Selected Assignment</h3>

            <div id="titles">
                <h4>Grade</h4>
                <h4>Statistics</h4>
            </div>

            <div id="tableContainer">

                <div id="leftTable">

                    <?php
                    include "connectToDB.php";
                    // Get all students with a grade for this assignment
                    $sql = "SELECT studentId, score FROM grade WHERE assignmentName = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$_COOKIE["assignment"]]);
                    $set = $stmt->fetch();



                    $sql1 = "SELECT assignmentName FROM grade WHERE studentId=?";
                    $stmt = $pdo->prepare($sql1);
                    $stmt->execute([$row['studentId']]);
                    $name = $stmt->fetch();
                    echo "<p>Grade" . $name['firstName'] . " " . $name['lastName'] . ": " . $row['score'] . "%</p>";

                    ?>

                </div>

                <div id="lightTable">
                    <?php
                    include "connectToDB.php";
                    // Get all students with a grade for this assignment
                    $sql = "SELECT score  FROM grade WHERE assignmentName = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$_COOKIE["assignment"]]);
                    $scores = $stmt->fetchAll();
                    //$scores[] = $rawScores['score'];
                    $total = 0;
                    $count = count($scores);

                    $list = [];
                    foreach ($scores as $s) {
                        array_push($list, $s['score']);
                    }

                    if ($count != 0) {
                        foreach ($list as $l) {
                            $total = $total + $l;
                        }

                        $average = $total / $count;
                        echo "<p>Class mean: " . $average . "%</p>";

                        sort($list);

                        $half = (int) ($count / 2);

                        if ($count % 2 != 0) {
                            $median = $list[$half];
                        } else {
                            $median = ($list[$half] + $list[$half - 1]) / 2;
                        }

                        echo "<p>Class median: " . $median . "%</p>";


                        $variance = 0.0;

                        foreach ($list as $x) {
                            $variance += pow(($x - $average), 2);
                        }

                        $std = (float) sqrt($variance / $count);
                        echo "<p>Standard deviation: " . $std . "%</p>";
                    }

                    ?>
                </div>
            </div>

            <div id="titles">
                <h4>Calendar</h4>
            </div>

            <div id="tableContainer">

                <button id="calendarButton" style="height: 10%; margin: auto;"><a href="calendar.html">Access Calendar</a></button>

            </div>

        </div>
    </div>

    <!---------------------------------------------------------- Add Assignment ---------------------------------------------------------->
    <div id="middleSectionAssignment" style="display:none;">
        <form id="questionsForm" action="createNewAssignment.php" method="post">

            <h3 id="assignmentName">Assignment builder</h3>

            <div id="titles">
                <h4>Informations</h4>
            </div>

            <div id="tableContainerAssignment">

                <br>
                <div class="formSection">
                    <label>Assignment Name</label>
                    <input type="text" name="assignmentName">
                </div>

                <br>

                <br>
                <div class="formSection">
                    <label>Weight</label>
                    <input type="number" max=100 name="assignmentWeight">
                </div>

                <br>

                <br>
                <div class="formSection">
                    <label>Number of Questions</label>
                    <input type="number" oninput="addQuestion()" max=100 id="numberQuestionInput" name="assignmentNumberQuestions">
                </div>

                <br>

                <br>
                <div class="formSection">
                    <label>Due date</label>
                    <input type="datetime-local" id="date" min="2000-01-02" name="assignmentDueDate">
                </div>

                <br>

                <div class="formSection">
                    <label>Assignment Description</label>
                    <textarea id="assignmentDescription" name="assignmentDescription" rows="4" cols="37"></textarea>
                </div>


            </div>
            <!---------------------------------------------------------- Second table of Add Assignment ---------------------------------------------------------->
            <h3 id="assignmentName">Questions</h3>

            <div id="titles">
                <h4>Question Number</h4>
                <h4>Weight</h4>
            </div>
            <div id="tableContainer">
                <br id="spaceHolder">
                <div id="leftTableAssignment">



                </div>
                <div id="lightTableAssignment">

                </div>

            </div>

            <h4 id="submitButton">
                <span>
                    <input type="submit" name="submit" value="Submit">
                </span>
                <button onclick="location.reload()">Cancel</button>
            </h4>


        </form>
    </div>

    <!------------------------------------------------------------------------------Popup--------------------------------------------------------------------------------------->
    <div class="popup" id="popup-1">
        <div class="overaly"></div>
        <div class="content">
            <div class="close-btn" onclick="closePopup()">&times;</div>
            <h1>About us</h1>
            <p>We are a school with a student management system</p>
        </div>
    </div>

    <div class="popup" id="popup-2">
        <div class="overaly"></div>
        <div class="content">
            <div class="close-btn" onclick="closePopup2()">&times;</div>
            <h1>Academic Integrity</h1>
            <p>Academic Integrity text</p>
        </div>
    </div>

    <!------------------------------------------------------------------------------Footer--------------------------------------------------------------------------------------->

    <footer id="footer">
        <div class=" contaier">
            <div class="row">
                <div class="footer-col">
                    <h4>School</h4>
                    <ul>
                        <li><a href="#" onclick="togglePopup()">about us</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Get Help</h4>
                    <ul>
                        <li><a href="#">FaQ</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Online Shop</h4>
                    <ul>
                        <li><a href="#">Books</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Rules</h4>
                    <ul>
                        <li><a href="#" onclick="togglePopup2()">Academic Integrity</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>





</body>

</html>