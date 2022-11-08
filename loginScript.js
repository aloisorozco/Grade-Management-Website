function loginButtonClicked(){
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (validateEmail(email) && validatePassword(password)) {
        document.getElementById("validEmailPasswordMsg").innerHTML = "";
        if (window.location.pathname.includes("student")) {
            window.location = "studentMainPage.html";
        }
        else {
            window.location = "teacherMainPage.html";
        }
        
    }
    else {
        document.getElementById("validEmailPasswordMsg").innerHTML = "Invalid credentials";
    }
    
}

function validateEmail(email) {
    var validRegex = /^\S+@\S+\.\S+$/;
    return validRegex.test(email);
}

function validatePassword(password) {
    var validRegex = /^(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{8,20}$/;
    return validRegex.test(password);
}