function registerButtonClicked() {

    var firstName = document.getElementById("first-name").value;
    var lastName = document.getElementById("last-name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm-password").value;

    var red = "#D90429";

    if (validateName(firstName) && validateName(lastName) && validateEmail(email) && validatePassword(password) && validateConfirm(password, confirmPassword)) {
        const validMsgs = document.getElementsByClassName("valid-msgs");
        for (let i = 0; i < validMsgs.length; i++) {
            validMsgs[i].style.color="black";
        }
        document.getElementById("first-name").style.border="none";
        document.getElementById("last-name").style.border="none";
        document.getElementById("email").style.border="none";
        document.getElementById("password").style.border="none";
        document.getElementById("confirm-password").style.border="none";

        if (window.location.pathname.includes("student")) {
            window.location = "studentLogin.html";
        }
        else {
            window.location = "teacherLogin.html";
        }
    }
    else {
        if (!validateName(firstName)) {
            console.log("invalid first name");
            document.getElementById("validFirstNameMsg").style.color=red;
            document.getElementById("first-name").style.border="solid 1px "+red;
        }
        else {
            document.getElementById("validFirstNameMsg").style.color="black";
            document.getElementById("first-name").style.border="none";
        }
        if (!validateName(lastName)) {
            console.log("invalid last name");
            document.getElementById("validLastNameMsg").style.color=red;
            document.getElementById("last-name").style.border="solid 1px "+red;
        }
        else {
            document.getElementById("validLastNameMsg").style.color="black";
            document.getElementById("last-name").style.border="none";
        }
        if (!validateEmail(email)) {
            console.log("invalid email");
            document.getElementById("validEmailMsg").style.color=red;
            document.getElementById("email").style.border="solid 1px "+red;
        }
        else {
            document.getElementById("validEmailMsg").style.color="black";
            document.getElementById("email").style.border="none";
        }
        if (!validatePassword(password)) {
            console.log("invalid pss");
            document.getElementById("validPasswordMsg").style.color=red;
            document.getElementById("password").style.border="solid 1px "+red;
        }
        else {
            document.getElementById("validPasswordMsg").style.color="black";
            document.getElementById("password").style.border="none";
        }
        if (!validateConfirm(password, confirmPassword)) {
            console.log("invalid confrim");
            document.getElementById("validConfirmMsg").style.color=red;
            document.getElementById("confirm-password").style.border="solid 1px "+red;
        }
        else {
            document.getElementById("validConfirmMsg").style.color="black";
            document.getElementById("confirm-password").style.border="none";
        }
    }
}

function validateName(name) {
    var regex = /^[a-zA-Z ]{2,30}$/
    return regex.test(name);
}

function validateEmail(email) {
    var validRegex = /^\S+@\S+\.\S+$/;
    return validRegex.test(email);
}

function validatePassword(password) {
    var validRegex = /^(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{8,20}$/;
    return validRegex.test(password);
}

function validateConfirm(password, confirmPassword) {
    if (confirmPassword == "" || confirmPassword == null) {
        return false;
    }
    return password === confirmPassword;
}

function clearMsgs(item) {
    item.style.color = "black";
    item.style.border = "none";
  }