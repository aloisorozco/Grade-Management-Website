var mediaLarge = window.matchMedia("(min-width: 1100px)");
mediaLarge.addEventListener("change",mediaLargeHandler);
var indexq = 1; 

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
