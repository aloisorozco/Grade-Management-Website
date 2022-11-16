<?php 

include "verifyUser.php";

include "connectToDB.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="teacherMainPage.css">
    <link rel="stylesheet" href="profile_button.css">
    <link rel="stylesheet" href="footerTeacherMainPage.css">
    <script src="studentManagementHome.js"></script>
</head>
<body>
    <header>
        <nav id="mainNav">
            <div id="subSection">
                <img onclick="menuToggler()" id="books" src="menu.png" alt="Image of a menu icon">
                <img id="menuIcon" src="book-stack.png" alt="Image of a book stack">
                <p>Student Management System</p>
            </div>
                <div id="subSection">
                    <p id="teacherName">Teacher Name</p>
                    <div class="action">
                         <div class="profile" onclick="activateMenu();">
                             <img src="ProfilePictures/profile_default.jpg" alt="Profile Picture">
                         </div>
                         <div class="menu">
                             <h3>Menu</h3>
                             <ul>
                                 <li><img src="ProfilePictures/profile.png" alt=""><a href="#">Profile</a></li>
                                 <li><img src="ProfilePictures/help.png" alt=""><a href="#">Grades</a></li>
                                 <li><img src="ProfilePictures/help.png" alt=""><a href="#">Settings</a></li>
                                 <li><img src="ProfilePictures/logout.png" alt=""><a href="teacherLogin.html">Logout</a></li>
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
            <form action="chartPageTeacher.html" onclick="menuToggler()">
                <button>Chart For Teacher</button>
            </form>
            <form onclick="menuToggler(); changeAssignmentName()">
                <button type="button">Add assignment</button>
            </form>
            
        </nav>

        <!---------------------------------------------------------- Default ---------------------------------------------------------->
        <div id="middleSection">
            <h3 id="assignmentName">Selected Assignment</h3>

            <div id="titles">
                <h4>Grades</h4>
                <h4>Statistics</h4>
            </div>

            <div id="tableContainer">
     
                <div id="leftTable">
                    <p>Student Name: grade%</p>
                    <p>Student Name: grade%</p>
                    <p>Student Name: grade%</p>
                    <p>Student Name: grade%</p>
                    <p>Student Name: grade%</p>
                    <p>Student Name: grade%</p>
                    <p>Student Name: grade%</p>
                    <p>Student Name: grade%</p>
                    <p>Student Name: grade%</p>
                    <p>Student Name: grade%</p>
                    <p>Student Name: grade%</p>
                    <p>Student Name: grade%</p>

                </div>
                <div id="lightTable">
                    <p>Class mean: grade%</p>
                    <p>Class median: grade%</p>
                    <p>Standard deviation: grade%</p>
                </div>

            </div>
            <img src="snd.png" alt="A gaussian distribution">
        </div>

        <!---------------------------------------------------------- Add Assignment ---------------------------------------------------------->
        <div id="middleSectionAssignment" style="display:none;">
            <form id="questionsForm">


                
            <h3 id="assignmentName">Assignment builder</h3>

            <div id="titles">
                <h4>Informations</h4>
            </div>

            <div id="tableContainerAssignment">

                <br>
                <div class="formSection">
                    <label>Assignment Name</label>
                    <input type="text">
                </div>

                <br>

                <br>
                <div class="formSection">
                    <label>Weight</label>
                    <input type="number">
                </div>

                <br>

                <br>
                <div class="formSection">
                    <label>Number of Questions</label>
                    <input type="number" oninput="addQuestion()" id="numberQuestionInput">
                </div>

                <br>

                <br>
                <div class="formSection">
                <label>Due date</label>
                <input type="date" id="date">
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
                        <input type="submit" name="submit"  value="Submit">
                    </span>
                    <button onclick="location.reload()">Cancel</button>
                </h4>

                
        </form>
        </div>



    </div>

    <footer>
        <div class="contaier">
            <div class="row">
                <div class="footer-col">
                    <h4>School</h4>
                    <ul>
                        <li><a href="#">about us</a></li>
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
                        <li><a href="#">Academic Integrity</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>





</body>
</html>