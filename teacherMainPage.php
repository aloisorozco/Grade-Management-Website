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
    <title>Teacher Main Page</title>
    <link rel="stylesheet" href="teacherMainPage.css">
    <link rel="stylesheet" href="profile_button.css">
    <link rel="stylesheet" href="footerTeacherMainPage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.cookie = "assignment= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"

        function displayAssignment(name){
            document.getElementById('titles').style.display = 'flex';
            document.getElementById('submitButton').style.display = 'block';
            document.getElementById('statisticTable').style.display = 'block';
            document.getElementById('tableContainer').style.display = 'flex';
            document.getElementById('middleSectionAssignment').style.display = "none";
            document.getElementById('middleSection').style.display = "flex";
            document.cookie = "assignment=" + name;
            document.getElementsByClassName("removeMe")[0].style.display = "none";
            document.getElementById('tableContainer').style.height = "80%";
            console.log(document.cookie);
            document.getElementById('assignmentName').textContent = String(name);
            document.getElementById('titleStatistics').style.display = "block";
    
            //document.getElementById("leftTable").innerHTML = '<?php echo addGrade()?>';
            updateDiv();
        }
        function updateDiv()
            { 
                    $( "#leftTable" ).load(window.location.href + " #leftTable" );
                    $( "#lightTable" ).load(window.location.href + " #lightTable" );
                    $( "#updateMe" ).load(window.location.href + " #updateMe" );
            }
    </script>
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
                                 <li><img src="ProfilePictures/profile.png" alt=""><a href="teacherUpdateAccount.php">Profile</a></li>
                                 <li><img src="ProfilePictures/help.png" alt=""><a href="#">Grades</a></li>
                                 <li><img src="ProfilePictures/help.png" alt=""><a href="#">Settings</a></li>
                                 <li><img src="ProfilePictures/logout.png" alt=""><a href="teacherLogin.php">Logout</a></li>
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

            <?php include "AddNavElement.php" ?>

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
            <form onclick="menuToggler(); location.reload()">
                <button>Grade Chart</button>
            </form>
            <form onclick="menuToggler(); changeAssignmentName()">
                <button type="button">Add assignment</button>
            </form>
            <button id="dark-button">
                <i class="dark-button"></i>Switch Theme
            </button> 


        </nav>

        <!---------------------------------------------------------- Default ---------------------------------------------------------->

            <form id="middleSection" action="updateGrades.php" method="POST">

                <h3 id="assignmentName">Average Grades</h3>

                <div id="titles">
                    <h4>Student ID & Grades</h4>
                </div>

                <div id="tableContainer">
        
                    <div id="leftTable">

                    <?php
                            include "connectToDB.php";
                            // Get all students of this course
                            $sql = "SELECT id FROM students WHERE teacherId = ?";
                            $stmt= $pdo->prepare($sql);
                            $stmt->execute([$_COOKIE["id"]]);
                            $students = $stmt->fetchAll();
                            // Get all students with a grade for this assignment


                            //Get the name of each of those students and echo it

                            foreach($students as $row){

                                $sql = "SELECT score FROM grade WHERE assignmentName = ? AND studentId = ? AND teacherId = ?";
                                $stmt= $pdo->prepare($sql);
                                $stmt->execute([$_COOKIE["assignment"],$row['id'],$_COOKIE["id"]]);
                                $set = $stmt->fetch();
                                
                                echo "<div class='formSection' style='margin-top:6%;'> <label>".$row['id']."</label> <input type='number' style='width:auto; text-align:center;' max = '100' min = '0' value = '".$set['score']."' name='grade.".$row['id']."'> </div>";
                                
                                /*
                                $sql1 = "SELECT firstName, lastName FROM students WHERE id=?";
                                $stmt = $pdo->prepare($sql1);
                                $stmt->execute([$row['studentId']]);
                                $name = $stmt->fetch();
                                echo "<p>" . $name['firstName'] . " " . $name['lastName'] . ": " . $row['score']. "%</p>";*/
                            }
                        ?>


                    </div>

                </div>
                
                <div id="titleStatistics">
                    <h4>Statistics</h4>
                </div>
                    <div id = "statisticTableContainer">
                        <div id="statisticTable">
                            <div id = "updateMe">
                                <div class = "flex">
                                    <?php
                                        include "connectToDB.php";
                                        // Get all students with a grade for this assignment
                                        $sql = "SELECT score  FROM grade WHERE assignmentName = ? AND teacherId = ?";
                                        $stmt= $pdo->prepare($sql);
                                        $stmt->execute([$_COOKIE["assignment"],$_COOKIE["id"]]);
                                        $scores = $stmt->fetchAll();
                                        //$scores[] = $rawScores['score'];
                                        $total = 0;
                                        $count = count($scores);

                                        $list = [];
                                        foreach($scores as $s){
                                            array_push($list, $s['score']);
                                        }

                                        if($count != 0){
                                            foreach($list as $l){
                                                $total = $total + $l;
                                            }

                                            $average = round($total/$count,2);
                                            echo "<span style='display: inline-block;' >Mean: " . $average ."%</span>";

                                            sort($list);

                                            $half = (int)($count/2); 
                                            
                                            if($count % 2 !=0){
                                                $median = $list[$half];
                                            }

                                            else{
                                                $median = round(($list[$half] + $list[$half-1])/2,2);
                                            }

                                            echo "<span style='display: inline-block;'>Median: " . $median ."%</span>";
                                            

                                            $variance = 0.0;

                                            foreach($list as $x){
                                                $variance += pow(($x - $average),2);
                                            }

                                            $std = (float)sqrt($variance/$count);
                                            //echo "<span style='display: inline-block;'>STD: " . $std ."%</span>";
                                        }
                                        
                                        ?>
                                </div>
                            <!--
                            <p>Class mean: grade%</p>
                            <p>Class median: grade%</p>
                            <p>Standard deviation: grade%</p>
                            -->
                        </div>
                    </div>
                </div>
                
                <!--<img src="snd.png" alt="A gaussian distribution" display = "block" class="removeMe">-->
                <canvas id = "myChart" display="block" class="removeMe" height="25px" width = "100px">

                <?php
                include "connectToDB.php";

                try{
                $sqlScore = "SELECT score FROM grade";
                $result = $pdo->query($sqlScore);
                if($result->rowCount()>0){
                    $gradeArray = array();
                    while($row = $result->fetch()){
                        $gradeArray[] = $row["score"];
                    }
                    unset($result);
                }else{
                    echo "No Records Found";
                }
                }catch(PDOException $e){
                    die("Error: Could not make query".$e->getMessage());
                }
                
                $sqlLabel = "SELECT assignmentName FROM grade";
                $result2 = $pdo->query($sqlLabel);
                if($result2->rowCount()>0){
                    $labelArray = array();
                    while($row2 = $result2->fetch()){
                        $labelArray[] = $row2["assignmentName"];
                    }
                    unset($result2);
                }
                
                $sqlAssignmentNames = "SELECT name FROM assignment";
                $result3 = $pdo->query($sqlAssignmentNames);
                if($result3->rowCount()>0){
                    $assignmentNames = array();
                    while($row3 = $result3->fetch()){
                        $assignmentNames[] = $row3["name"];
                    }
                    unset($result3);
                }

                //now we have this array of just assignment names;
                //gets get values only of specific assignment

                
                
                $averageFromGrade = array();
                
                $assignemtGrade = array();
                $scoreFromAssignmentName = "SELECT avg(score) FROM grade GROUP BY assignmentName";
                $result4 = $pdo->query($scoreFromAssignmentName);
                    
                if($result4->rowCount()>0){
                    while($row4 = $result4->fetch()){
                        $assignmentGrade[] = $row4["avg(score)"];
                        
                    }
                    array_push($averageFromGrade,array_sum($assignmentGrade)/count($assignmentGrade));
                }
                
                

                
                
                
                //array_push($averageFromGrade,array_sum($assignmentGrade)/count($assignmentGrade));
                //array_push($averageFromGrade,array_sum($assignmentGrade2)/count($assignmentGrade2));

                //"SELECT assignmentName,avg(score) FROM grade GROUP BY assignmentName"

                

                ?>
                <script>
                    console.log(<?php print_r(json_encode($result4));?>);
                    console.log(<?php echo json_encode($assignmentNames); ?>);
                    console.log(<?php echo json_encode($gradeArray); ?>);
                    console.log(<?php echo json_encode($labelArray); ?>);
                    console.log(<?php echo json_encode($assignmentGrade); ?>);
                    



                    let grades = <?php echo json_encode($assignmentGrade); ?>;
                    
                    
                    let labels = <?php echo json_encode($assignmentNames);?>;

                    Chart.defaults.backgroundColor = '#C8C8C8';
                    Chart.defaults.borderColor = '#000000';
                    Chart.defaults.color = '#000000';

                   
                  
                    const data = {
                      labels: labels,
                      datasets: [{
                        label: 'Your Overall Grades',

                        borderColor: 'rgb(0,0,0))',
                        color: 'rgb(240,248,255))',
                        tesnion: 0.4,
                        data: grades,
                      }]
                    };
                  
                    const config = {
                      type: 'line',
                      data: data,
                      options: {
                        y: {
                            min: 0,
                            max: 100
                            
                        }
                        
                      }
                    };
            
            
                    const myChart = new Chart(
                    document.getElementById('myChart'),config);
                
                    
                    </script>

                </canvas>
                <h4 id="submitButton">
                        <button type="button" onclick="window.location.href='removeAssignment.php'">Remove Assignment</button>
                        <button type="submit">Update Grades</button>
                </h4>
            </form>
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

            <div id="titleAssignment">
                <h4>Question Number</h4>
                <h4>Weight</h4>
            </div>
                <div id="tableContainerAssignmentQuestions">
                    <br id="spaceHolder">
                    <div id="leftTableAssignment">
                        
                            
                        
                    </div>
                    <div id="lightTableAssignment">
                    
                    </div>

                </div>

                <p id="weight-error-msg"></p>

                <h4 id="submitButtonAssignment">
                    <span>
                        <!------<input type="submit" name="submit" value="Submit">------>
                        <button type="button" onclick="addAssignment()">Submit</button>
                    </span>
                    <button type="button" onclick="location.reload()">Cancel</button>
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

    <script src="studentManagementHome.js"></script>
    <script src="studentAssessmentPageDarkMode.js"></script>

</body>
</html>