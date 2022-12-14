var mediaLarge = window.matchMedia("(min-width: 1100px)");
mediaLarge.addEventListener("change",mediaLargeHandler);
var indexq = 1; 

if (window.location.pathname.includes("student")) {
    var studentName = document.getElementById("studentName");
    studentName.innerHTML = getCookie('name');
}
else {
    var teacherName = document.getElementById("teacherName");
    teacherName.textContent = getCookie('name');
}


function togglePopup(){
    document.getElementById("popup-1").classList.toggle("active");
    var all = document.getElementById('middleSection');
    var all1 = document.getElementById('middleSectionAssignment');
    all.style.filter = "blur(3px)";
    all1.style.filter = "blur(3px)";
}

function closePopup(){
    document.getElementById("popup-1").classList.toggle("active");
    var all = document.getElementById('middleSection');
    var all1 = document.getElementById('middleSectionAssignment');
    all.style.filter = "blur(0px)";
    all1.style.filter = "blur(0px)";
}

function togglePopup2(){
    document.getElementById("popup-2").classList.toggle("active");
    var all = document.getElementById('middleSection');
    var all1 = document.getElementById('middleSectionAssignment');
    all.style.filter = "blur(3px)";
    all1.style.filter = "blur(3px)";
}

function closePopup2(){
    document.getElementById("popup-2").classList.toggle("active");
    var all = document.getElementById('middleSection');
    var all1 = document.getElementById('middleSectionAssignment');
    all.style.filter = "blur(0px)";
    all1.style.filter = "blur(0px)";
}

function activateMenu(){
    const toggleMenu = document.querySelector('.menu');
    toggleMenu.classList.toggle('active');
}

function menuToggler(){
    if(window.innerWidth >= 1100) return;
    var buffer = document.getElementById('sideNav').style.display;
    
    if(buffer == 'flex'){
        document.getElementById('sideNav').style.display = 'none';
        var all = document.getElementById('middleSection');
        var all1 = document.getElementById('middleSectionAssignment');
        all.style.filter = "blur(0px)";
        all1.style.filter = "blur(0px)";
    }

    else{
        var all = document.getElementById('middleSection');
        var all1 = document.getElementById('middleSectionAssignment');
        all.style.filter = "blur(3px)";
        all1.style.filter = "blur(3px)";
        document.getElementById('sideNav').style.display = 'flex';
    }
}

function changeAssignmentName(){
    document.getElementById('middleSectionAssignment').style.display = 'block';
    document.getElementById('middleSection').style.display = 'none';
     document.getElementById('titles').style.display = 'flex';
    //document.getElementById('header').style.backgroundColor='red';
}

function mediaLargeHandler(media) {
    if(media.matches){
        document.getElementById('sideNav').style.display = 'flex';
        document.getElementById('middleSection').style.filter = "blur(0px)";
        document.getElementById('middleSectionAssignment').style.filter = "blur(0px)";
    }
    else{
        document.getElementById('sideNav').style.display = 'none';
    }
}

function addQuestion(){
    let container = document.getElementById('lightTableAssignment');
    let containerLeft = document.getElementById('leftTableAssignment');
    var nb = document.getElementById('numberQuestionInput').value;
    if(nb>100) return;

    container.innerHTML='';
    containerLeft.innerHTML='';
    indexq=1;

    for(var i = 0; i<nb;i++){

        let input = document.createElement('input');
        input.size=4;
        input.name = "q" + i;
        input.className = "question-weight-input";
        input.style.marginLeft='4em';
        containerLeft.appendChild(document.createElement('br'));
        let index = document.createElement('span');
        index.textContent=indexq;
        index.style.height='21.74px';
        index.style.display ='block';
        containerLeft.appendChild(index);
        container.appendChild(document.createElement('br'));
        container.appendChild(input);
        container.appendChild(document.createElement('br'));
        indexq++;
    }
}

var d = new Date().toDateString();
var d1 = new Date();
var hours = d1.getHours();
console.log(hours.toString());
if(hours.toString().length == 1){
    hours = "0" + hours;
}
var minutes = d1.getMinutes();
if(minutes.toString().length == 1){
    minutes = "0" + minutes;
}


s = d.split(" ");
var newString = s[3] +"-" + new Date().toISOString().split("-")[1] + "-" + s[2] + "T" + hours + ":" + minutes + ":00";

document.getElementById('date').min = newString;

/*
function ajaxPost() {
    var form = document.getElementById("questionsForm");
    var data = new FormData(form);
    var request = new XMLHttpRequest();
    request.open("POST", "db.php");
    console.log('submited')
    form.reset();
    location.reload();
    return false;
  }
  */

console.log(document.cookie);

//From https://www.tabnine.com/academy/javascript/how-to-get-cookies/
function getCookie(cName) {
    const name = cName + "=";
    const cDecoded = decodeURIComponent(document.cookie); //to be careful
    const cArr = cDecoded.split('; ');
    let res;
    cArr.forEach(val => {
      if (val.indexOf(name) === 0) res = val.substring(name.length);
    })
    return res;
  }

function addAssignment() {
    if (checkQuestionsWeight()) {
        document.getElementById("weight-error-msg").innerHTML = "";
        document.getElementById("questionsForm").submit();
    }
    else {
        document.getElementById("weight-error-msg").innerHTML = "Weight of questions must equal 100";
    }
}


function checkQuestionsWeight() {
    const questionWeightArr = document.getElementsByClassName("question-weight-input");

    console.log(questionWeightArr.length);

    let totalWeight = 0;

    for (let i = 0; i < questionWeightArr.length; i++) {
        console.log(questionWeightArr[i].value);
        totalWeight += parseInt(questionWeightArr[i].value);
    }
    console.log(totalWeight);

    return totalWeight == 100;
}
