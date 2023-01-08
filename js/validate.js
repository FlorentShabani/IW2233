function validateRegister() {
    let fullname = document.getElementById("fullname").value;
    let username = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let date = document.getElementById("date").value;
    let password = document.getElementById("password").value;
    let cpassword = document.getElementById("cpassword").value;

    if(fullname == "" || username == "" || email == "" || date == "" || password == "" || cpassword == "") {
        alert("All fields are required!");
        return false;
    }

    if(!/^[A-Za-z]+\s[A-Za-z]+$/.test(fullname)) {
        alert("Invalid fullname!");
        return false;
    }

    if(!/^[a-zA-Z0-9_]{3,16}$/.test(username)) {
        alert("Invalid username!");
        return false;
    }

    if(!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(email)){
        alert("Invalid email!");
        return false;
    }

    if(!/^(0[1-9]|[1-2][0-9]|3[0-1])\.(0[1-9]|1[0-2])\.[0-9]{4}$/.test(date)) {
        alert("Invalid birthdate!");
        return false;
    }

    if(!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(password)){
        alert("Invalid password!");
        return false
    }

    if(!(cpassword == password)){
        alert("Confirm password must match password");
        return false;
    }
}

function validateLogin() {
    const RegUser = "admin";
    const RegPass = "admin";

    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if(username == "" || password == ""){
        alert("All fields are required!");
        return false;
    }

    if(!((username == RegUser) && (password == RegPass))) {
        alert("Invalid Username or Password!");
        return false;
    }
}

function validateContact() {
    let fullname = document.getElementById("fullname").value;
    let email = document.getElementById("email").value;
    let subject = document.getElementById("subject").value;
    let message = document.getElementById("message").value;

    if(fullname == "" || email == "" || subject == "" || message == ""){
        alert("All fields are required!");
        return false;
    }

    if(!/^[A-Za-z]+\s[A-Za-z]+$/.test(fullname)) {
        alert("Invalid Fullname!");
        return false;
    }

    if(!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(email)){
        alert("Invalid Email!");
        return false;
    }

    if(!/^[a-zA-Z0-9 ]{3,100}$/.test(subject)){
        alert("Invalid Subject");
        return false;
    }

    if(!/^[a-zA-Z0-9 .,!'?-]{3,480}$/.test(message)){
        alert("Invalid Message!");
        return false;
    }
}